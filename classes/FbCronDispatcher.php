<?php

namespace postyou;


class FbCronDispatcher {

	private function getAllPosts() {
		$fbConnector = FbConnector::getInstance(
			            array(
			                'connectionType' => ConnectionType::POST_GET
			            ));
    	$fbConnector->getPostsFromAllSitesAndSaveInDb($id);
	}

	private function getAllGaleries() {
         $fbConnector = FbConnector::getInstance(
            array(
                'connectionType' => ConnectionType::GALLERY_GET
            ));
        $fbConnector->getGalleryDataFromAllSites();
    }

	function setMinutelyCronJobs() {

	    $facebookSitesModels = \FacebookSitesModel::findAll();

	    if ($facebookSitesModels) {
		    foreach ($facebookSitesModels as $facebookSitesModel) {
		        if ($facebookSitesModel->synchronizePosts == 1 && $facebookSitesModel->autoSyncPosts == 1) {
		        	if ($facebookSitesModel->autoSyncPostOptions == 5) {
		        		$this->getAllPosts();
		        	}
		        } 
		        if ($facebookSitesModel->synchronizeGalleries && $facebookSitesModel->autoSyncGalleries == 1) {
		        	if ($facebookSitesModel->autoSyncGalleryOptions == 5) {
		        		$this->getAllGaleries();
		        	}
		        }
		    }
	    }

	}

	function setHourlyCronJobs() {

	    $facebookSitesModels = \FacebookSitesModel::findAll();

		if ($facebookSitesModels) {
		    foreach ($facebookSitesModels as $facebookSitesModel) {
		        if ($facebookSitesModel->synchronizePosts == 1 && $facebookSitesModel->autoSyncPosts == 1) {
		        	if ($facebookSitesModel->autoSyncPostOptions == 4) {
		        		$this->getAllPosts();
		        	}
		        } 
		        if ($facebookSitesModel->synchronizeGalleries && $facebookSitesModel->autoSyncGalleries == 1) {
		        	if ($facebookSitesModel->autoSyncGalleryOptions == 4) {
		        		$this->getAllGaleries();
		        	}
		        }
		    }
		}
	}

	function setDailyCronJobs() {

	    $facebookSitesModels = \FacebookSitesModel::findAll();

		if ($facebookSitesModels) {
		    foreach ($facebookSitesModels as $facebookSitesModel) {
		        if ($facebookSitesModel->synchronizePosts == 1 && $facebookSitesModel->autoSyncPosts == 1) {
		        	if ($facebookSitesModel->autoSyncPostOptions == 3) {
		        		$this->getAllPosts();
		        	}
		        } 
		        if ($facebookSitesModel->synchronizeGalleries && $facebookSitesModel->autoSyncGalleries == 1) {
		        	if ($facebookSitesModel->autoSyncGalleryOptions == 3) {
		        		$this->getAllGaleries();
		        	}
		        }
		    }
		}
	}

	function setWeeklyCronJobs() {

	    $facebookSitesModels = \FacebookSitesModel::findAll();

		if ($facebookSitesModels) {
		    foreach ($facebookSitesModels as $facebookSitesModel) {
		        if ($facebookSitesModel->synchronizePosts == 1 && $facebookSitesModel->autoSyncPosts == 1) {
		        	if ($facebookSitesModel->autoSyncPostOptions == 2) {
		        		$this->getAllPosts();
		        	}
		        } 
		        if ($facebookSitesModel->synchronizeGalleries && $facebookSitesModel->autoSyncGalleries == 1) {
		        	if ($facebookSitesModel->autoSyncGalleryOptions == 2) {
		        		$this->getAllGaleries();
		        	}
		        }
		    }
		}
	}

	function setMonthlyCronJobs() {

	    $facebookSitesModels = \FacebookSitesModel::findAll();

		if ($facebookSitesModels) {
		    foreach ($facebookSitesModels as $facebookSitesModel) {
		        if ($facebookSitesModel->synchronizePosts == 1 && $facebookSitesModel->autoSyncPosts == 1) {
		        	if ($facebookSitesModel->autoSyncPostOptions == 1) {
		        		$this->getAllPosts();
		        	}
		        } 
		        if ($facebookSitesModel->synchronizeGalleries && $facebookSitesModel->autoSyncGalleries == 1) {
		        	if ($facebookSitesModel->autoSyncGalleryOptions == 1) {
		        		$this->getAllGaleries();
		        	}
		        }
		    }
		}
	}
}