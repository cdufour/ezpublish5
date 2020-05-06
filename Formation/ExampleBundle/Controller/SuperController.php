<?php

namespace Formation\ExampleBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eZ\Bundle\EzPublishCoreBundle\Controller;

class SuperController extends Controller
{
    public function defaultAction()
    {
        // Utilisation de services (containers)

        // $calculate = $this->get('formation_example.calculate');
        // $calculate->add(2,9);
        

        // $translator = $this->get('formation_example.translator');
        // echo $translator->translate('hello', 'it');

        // Create content
        // $fields = array(
        //     array('name' => 'name', 'value' => 'Super Folder')
        // );
        // $newFolder = $this->createContent(2, 'folder', $fields);


        //Read content
        //$this->readContent(68);


        // Update content
        $fields = array(
            array('name' => 'name', 'value' => 'Super Ultra Maxi Folder')
        );
        $updatedContent = $this->updateContent(121, $fields); // NodeId 121


        // Delete content
        //$this->deleteContent(118); // ObjectId 118

        return $this->render('FormationExampleBundle:Super:default.html.twig', 
        array());    
    }

    private function createContent($parentLocationId, $contentType, $fields)
    {
        //$repository = $this->getContent()->get('ezpublish.api.repository');
        //$repository = $this->getContainer()->get('ezpublish.api.repository');
        $repository = $this->get('ezpublish.api.repository');

        
        $userService = $repository->getUserService();
        $user = $userService->loadUserByCredentials('admin', '1234');
        $repository->setCurrentUser($user);


        $contentTypeService = $repository->getContentTypeService();
        $contentType = $contentTypeService->loadContentTypeByIdentifier($contentType);
        $contentService = $repository->getContentService();
        $contentCreateStruct = $contentService->newContentCreateStruct($contentType, 'eng-US');
        
        foreach($fields as $field) {
            $contentCreateStruct->setField($field['name'], $field['value']);
        }

        $locationService = $repository->getLocationService();
        $locationCreateStruct = $locationService->newLocationCreateStruct($parentLocationId);

        $draft = $contentService->createContent($contentCreateStruct, array($locationCreateStruct));
        return $contentService->publishVersion($draft->versionInfo);
    }

    private function readContent($objectId)
    {
        $repository = $this->get('ezpublish.api.repository');
        $content = $repository->getContentService()->loadContent($objectId);

        // echo '<pre>';
        // var_dump($content->getFieldValue('title'));
        // echo '</pre>';

        echo $content->getFieldValue('title')->text;
    }

    private function updateContent($locationId, $fields)
    {
        $repository = $this->get('ezpublish.api.repository');

        $userService = $repository->getUserService();
        $user = $userService->loadUserByCredentials('admin', '1234');
        $repository->setCurrentUser($user);

        $locationService = $repository->getLocationService();
        $location = $locationService->loadLocation($locationId);
        $contentService = $repository->getContentService();
        $contentInfo = $contentService->loadContentInfo($location->contentInfo->id);
        $contentDraft = $contentService->createContentDraft($contentInfo);
        $contentUpdateStruct = $contentService->newContentUpdateStruct();

        foreach ($fields as $field) {
            $contentUpdateStruct->setField($field['name'], $field['value']);
        }

        $contentDraftUpdated = $contentService->updateContent($contentDraft->versionInfo, $contentUpdateStruct);
        return $contentService->publishVersion($contentDraftUpdated->versionInfo);
    }

    private function deleteContent($locationId)
    {
        $repository = $this->get('ezpublish.api.repository');

        $userService = $repository->getUserService();
        $user = $userService->loadUserByCredentials('admin', '1234');
        $repository->setCurrentUser($user);

        $contentInfo = $repository->getContentService()->loadContentInfo($locationId);
        $repository->getContentService()->deleteContent($contentInfo);
    }



}
