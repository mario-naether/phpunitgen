<?php
namespace PhpUnitGen\Utility;

/**
 * Class ClassFromFileService.
 */
class ClassNameUtility
{
    /**
     * Using from http://jarretbyrne.com/2015/06/197/.
     *
     * @param $pathToFile
     *
     * @return mixed|string
     */
    public static function getClassNameFromFile($pathToFile)
    {
        //Grab the contents of the file
        $contents = file_get_contents($pathToFile);

        //Start with a blank namespace and class
        $namespace = $class = null;

        //Set helper values to know that we have found the namespace/class token
        // and need to collect the string values after them
        $gettingNamespace = $gettingClass = false;

        //Go through each token and evaluate it as necessary
        foreach (token_get_all($contents) as $token) {
            //If this token is the namespace declaring, then flag that the next tokens will be the namespace name
            if (is_array($token) && $token[0] == T_NAMESPACE) {
                $gettingNamespace = true;
            }

            //If this token is the class declaring, then flag that the next tokens will be the class name
            if (is_array($token) && $token[0] == T_CLASS) {
                $gettingClass = true;
            }

            //While we're grabbing the namespace name...
            if ($gettingNamespace === true) {
                //If the token is a string or the namespace separator...
                if (is_array($token) && in_array($token[0], [T_STRING, T_NS_SEPARATOR])) {
                    //Append the token's value to the name of the namespace
                    $namespace .= $token[1];
                } elseif ($token === ';') {
                    //If the token is the semicolon, then we're done with the namespace declaration
                    $gettingNamespace = false;
                }
            }

            //While we're grabbing the class name...
            if ($gettingClass === true) {
                //If the token is a string, it's the name of the class
                if (is_array($token) && $token[0] == T_STRING) {
                    //Store the token's value as the class name
                    $class = $token[1];

                    //Got what we need, stope here
                    break;
                }
            }
        }

        //Build the fully-qualified class name and return it
        return $namespace ? $namespace . '\\' . $class : $class;
    }
}
