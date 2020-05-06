<?php
namespace Formation\ExampleBundle\Helper;

class Translator
{
    private $dico = array(
        'hello' => array(
            'fr' => 'salut',
            'it' => 'ciao'
        ),
        'sun' => array(
            'fr' => 'soleil',
            'it' => 'sole'
        )
    );


    public function translate($term, $lang)
    {
        $translation = 'Translation not found';
        foreach($this->dico as $k1 => $v1) {
            if ($k1 == $term) {
                $subdico = $this->dico[$k1];
                foreach($subdico as $k2 => $v2) {
                    if ($k2 == $lang) return $v2;
                }
            }
        }
        return $translation;
    }
}