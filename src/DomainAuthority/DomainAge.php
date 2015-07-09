<?php
namespace DomainAuthority;

use App;
use Config;

use Carbon\Carbon;

class DomainAge {

	/**
	 * Retrieves DoB of a domain with cURL request to WHOIS service
	 * @param  string $domain The domain to be checked for registration/activation/creation date
	 * @return Carbon         Carbon instance with DoB (registration/activation/creation date), null on failure
	 */
    public function since($domain)
    {
        $ch = curl_init("http://who.is/whois/$domain");
        curl_setopt_array($ch, [
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if( ! $response || 200 !== $status)
            return null;

        $response = strip_tags($response);

        $buffer = [];

        $labels = 'activated|created|registered|Activated|Created|Registered';
        $on = 'on|On';
        $months = 'January|February|March|April|May|June|July|August|September|October|November|December|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec';
        $spacing = '[\s\t\r\n]+';
        $timezone = "(?:{$spacing}\\d{2}:\\d{2}:\\d{2})?(?:{$spacing}([A-Z]{2,5}))?";
        $formats = "(\\d{2}/\\d{2}/\\d{4}{$timezone}|\\d{4}-\\d{2}-\\d{2}{$timezone}|(?:$months){$spacing}\\d{2},{$spacing}\\d{4}{$timezone})";

        if( ! preg_match("#(?:$labels)$spacing(?:$on):?$spacing$formats#smu", $response, $buffer))
            return null;

        if(2 > count($buffer))
            return null;

        if(isset($buffer[2]))
        {
            $zone = timezone_name_from_abbr($buffer[2]);
            if(false !== $zone && 0 === strpos($zone, 'Europe'))
                $buffer[1] = str_replace('/', '-', $buffer[1]);
        }

        date_default_timezone_get(isset($buffer[2]) ? 'Europe/Sofia' : 'UTC');
        $time = strtotime($buffer[1]);

        if( ! $time)
            return null;

        return new Carbon('@' . $time);
    }

    /**
     * Returns domain age with instant cURL request
     * @param  string $domain The domain to be resolved by WHOIS cURL request
     * @return int         	  Age of the domain in years
     */
    public function age($domain)
    {
        $since = $this->since($domain);

        if(!$since)
            return false;

        $interval = Carbon::now()->diff($since);

        return $interval->y;
    }

    /**
     * Calculates domain age by given string representation of since date
     * @param  string $date The date of creation/activation/registration
     * @return int       	The age of a domain by the given date, measured in years
     */
    public static function fromDate($date)
    {
        return Carbon::now()->diff(new Carbon($date))->y;
    }

}