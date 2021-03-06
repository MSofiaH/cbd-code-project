<?php
/**
 * Created by IntelliJ IDEA.
 * User: marthahidalgo
 * Date: 7/26/19
 * Time: 5:53 PM
 */

namespace App\Extensions;

use Illuminate\Support\Facades\Log;

class Lookup
{
    /**
     * @var int
     */
    public $matches;

    /**
     * @var string
     */
    public $line;

    /**
     * @var string
     */
    public $properName;

    /**
     * @var array
     */
    public $explodedLine;

    /**
     * @var array
     */
    public $possibleNames;

    /**
     * @var array
     */
    public $possibleNameLengths;

    /**
     * @var array
     */
    public $possibleNamesFirstLetters;


    public function __construct($line, $properName)
    {
        $this->matches = 0;
        $this->line = $line;
        $this->properName = $properName;

        $this->explodedLine = str_split($this->line);
        $splitNames = explode(' ', $this->properName);
        $this->possibleNames = count($splitNames) > 1 ? array_merge([$this->properName],$splitNames) : [$this->properName];

        foreach ($this->possibleNames as $possibleName)
        {
            $this->possibleNamesFirstLetters[] = $possibleName[0];
            $this->possibleNameLengths[] = strlen($possibleName);
        }
    }


    public function find()
    {
        // iterate through the each character in the exploded line
        for ($i = 0; $i < count($this->explodedLine); $i++)
        {
            // search for first letter match
            if (in_array($this->explodedLine[$i], $this->possibleNamesFirstLetters))
            {
                // if found, begin looking for names with proper name first
                foreach ($this->possibleNames as $index => $possibleName)
                {
                    // Get the substring of the possible name from the line at current position
                    $substringOfLine = substr($this->line, $i, $this->possibleNameLengths[$index]);
                    // if current substring of line matches the possible name (case sensitive), we have a match
                    if (strcmp($substringOfLine, $possibleName) == 0)
                    {
                        // increment matches
                        $this->matches++;
                        // jump in search index beyond current match
                        $i += $this->possibleNameLengths[$index];
                        // break current search
                        break;
                    }
                }
            }
        }

    }

}
