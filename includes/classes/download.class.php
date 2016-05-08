<?php
	/**
	* 
	*/

	class download extends HuntHelp
	{
		
		function readJson($url) {
			if (!empty($url)) {
				$command = YOUTUBEDL.' -j '.$url;
				$data = $this->cmd($command);
				if (!empty($data)) {
					return $data;
				} else {
					return false;
				}
			}
		}

		function download_item($url, $location = 'default') {
			global $youtube;
			if (!empty($url)) {
				if ($location == 'default') {
					$location = __DIR__;
				}
				$video_id = $youtube->get_youtube_id($url);
				$to_download = $location.'/'.$video_id;
				$command = YOUTUBEDL." -o \"$location/%(id)s\" $url";
				$data = $this->cmd($command);
				if (file_exists($to_download)) {
					return $to_download;
				} else {
					return false;
				}
			}
		}

		function download_multiple($array, $location)  {
			if (is_array($array)) {
				$downloaded = array();
				foreach ($array as $key => $url) {
					$fetched = $this->download_item($url, $location);
					if ($fetched) {
						$downloaded[] = $fetched;
					}
					return $fetched;
				}
			}
		}

		function direct_url($url) {
			if (!empty($url)) {
				$command = YOUTUBEDL.' -g '.$url;
				$durl = $this->cmd($command);
				if ($durl) {
					return rtrim($durl);
				} else {
					return false;
				}
			}
		}
	}
		
?>