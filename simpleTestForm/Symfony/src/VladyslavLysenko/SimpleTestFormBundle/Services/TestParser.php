<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 17.06.14
 * Time: 21:26
 */
namespace VladyslavLysenko\SimpleTestFormBundle\Services;
use VladyslavLysenko\SimpleTestFormBundle\Entity\Result;
class TestParser
{
    function parse($em, $data,$id,$form,$maxMark)
    {
        /**
         * calculating results
         */
        $result = 0;
        //$data = $this->get('request')->request->all();
        $questions = $data['vladyslavlysenko_simpletestformbundle_test']['questions'];

        foreach ($questions as $question) {
            if (gettype($question['variants']) == 'string') {
                $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')
                    ->findOneBy(array('description' => $question['variants']));

                $result += $entity->getQuantityOfPoints();
            }
            if (gettype($question['variants']) == 'array') {
                $entities = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')
                    ->findBy(array('description' => $question['variants']));
                //count($entities[0]->getQuestion()->getVariants());
                if (count($question['variants']) != count($entities[0]->getQuestion()->getVariants())) {
                    foreach ($entities as $entity) {
                        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')
                            ->findOneBy(array('description' => $entity->getDescription()));
//                        var_dump($entity);
                        $result += $entity->getQuantityOfPoints();
                    }
                }
            }
        }
        /**
         * saving result in DB
         */
        $res = new Result();
        $res->setName($form['name']->getData());
        $res->setMark($result);
        $res->setTestId($id);
        $percents = $result * 100 / $maxMark;


        $res->setPercents($percents);
        return $res;
    }

} 