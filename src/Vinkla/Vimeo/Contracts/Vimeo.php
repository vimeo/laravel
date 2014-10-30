<?php namespace Vinkla\Vimeo\Contracts;

interface Vimeo {

	/**
	 * Make an API request to Vimeo.
	 *
	 * @param string $url
	 * @param array $params
	 * @param string $method
	 * @param bool $json_body
	 * @return array
	 */
	public function request($url, $params = [], $method = 'GET', $json_body = true);

	/**
	 * Request the access token associated with this library.
	 *
	 * @return string
	 */
	public function getToken();

	/**
	 * Assign a new access token to this library.
	 *
	 * @param string $access_token
	 */
	public function setToken($access_token);

	/**
	 * Convert the raw headers string into an associated array
	 *
	 * @param string $headers
	 * @return array
	 */
	public static function parse_headers($headers);

	/**
	 * Request an access token. This is the final step of the
	 * OAuth 2 workflow, and should be called from your redirect url.
	 *
	 * @param string $code
	 * @param string $redirect_uri
	 * @return array
	 */
	public function accessToken($code, $redirect_uri);

	/**
	 * Get client credentials for requests.
	 *
	 * @param mixed $scope
	 * @return array
	 */
	public function clientCredentials($scope = 'public');

	/**
	 * Authorize the user.
	 *
	 * @param string $redirect_uri
	 * @param string $scope
	 * @param string $state
	 * @return string
	 */
	public function buildAuthorizationEndpoint($redirect_uri, $scope = 'public', $state = null);

	/**
	 * Upload a file.
	 *
	 * This should be used to upload a local file. If you want a
	 * form for your site to upload direct to Vimeo, you should
	 * look at the POST /me/videos endpoint.
	 *
	 * @param string $file_path
	 * @param boolean $upgrade_to_1080
	 * @param null $machine_id
	 * @return array Status
	 */
	public function upload($file_path, $upgrade_to_1080 = false, $machine_id = null);

	/**
	 * Replace the source of a single Vimeo video.
	 *
	 * @param string $video_uri
	 * @param string $file_path
	 * @param boolean $upgrade_to_1080
	 * @param null $machine_id
	 * @return array Status
	 */
	public function replace($video_uri, $file_path, $upgrade_to_1080 = false, $machine_id = null);

	/**
	 * Uploads an image to an individual picture response.
	 *
	 * @param  string $pictures_uri
	 * @param  string $file_path
	 * @param  boolean $activate
	 * @return string
	 */
	public function uploadImage($pictures_uri, $file_path, $activate = false);

}