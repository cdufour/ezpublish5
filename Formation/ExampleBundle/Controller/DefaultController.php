<?php

namespace Formation\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $MAX_WIDTH = 500;

    public function indexAction($name)
    {
        return $this->render('FormationExampleBundle:Default:index.html.twig', array('name' => $name));
    }

    public function testAction()
    {


        $students = array('Chris', 'Loïc', 'Ludo');
        $list = '<ul>';
        foreach($students as $student) {
            $list .= '<li>' . $student . '</li>';
        }
        $list .= '</ul>';

        //$res = new Response($list);
        //return $res;

        return $this->render(
            'FormationExampleBundle:Default:test.html.twig', 
            array(
                'students' => $students,
                'display' => true
            ));
    }

    public function squareAction($width, $color)
    {
        if ($width > $this->MAX_WIDTH) {
            return new Response("La largeur doit être inférieure ou égale à " . $this->MAX_WIDTH);
        }
        return $this->render(
            'FormationExampleBundle:Default:square.html.twig', 
            array('width' => $width, 'color' => $color));
    }

    public function studentAction($studentId)
    {
        return $this->render(
            'FormationExampleBundle:Default:student.html.twig', 
            array('studentId' => $studentId));
    }
}
