<?php
session_start();

/**
 * 
 */
class ProductsController
{

	public function get()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer ' . $_SESSION['user_data']->token
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {

			return $response->data;
		} else {
			return [];
		}
	}

	public function getBySlug($slug)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer ' . $_SESSION['user_data']->token
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {

			return $response->data;
		} else {
			return [];
		}
	}

	public function addProduct($name, $slug, $description, $features)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'name' => $name,
				'slug' => $slug,
				'description' => $description,
				'features' => $features
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer ' . $_SESSION['user_data']->token
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->data)  && is_object($response->data)) {
			header("Location: ../home.php");
		} else {
			error_log("error");
		}
	}

	public function updateProduct($nombre,$slug,$description,$features,$id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'PUT',
		  CURLOPT_POSTFIELDS => 'name='. $nombre. '&slug=' .$slug. '&description='.$description. '&features=' .$features. '&id='.$id ,
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Bearer ' . $_SESSION['user_data']->token
		  ),
		));
		
		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response);
		
		if (isset($response->data)  && is_object($response->data)) {
			header("Location: ../avanzada_unidad_4/home.php");
		} else {
			error_log("error");
		}
	}

	public function deleteProduct($id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$id,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'DELETE',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		)); 

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->code) && $response->code == 2) {
			
			header('Location: ../home.php?status=ok');
		}else{
			header('Location: ../home.php?status=error');
		}
	}
}
