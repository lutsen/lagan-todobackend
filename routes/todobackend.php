<?php

/**
 * JSON API routes for http://www.todobackend.com
 */



/**
 * Create right response for http://www.todobackend.com
 *
 * @var object $bean Redbean bean
 *
 * @return array Array with right keys for http://www.todobackend.com
 */
function formatTodo($bean) {

	return [
		'uid' => $bean->uid,
		'title' => $bean->title,
		'completed' => $bean->completed ? true : false,
		'order' => (int)$bean->position,
		'url' => APP_URL . '/todo/' . $bean->slug
	];

}

// Lazy CORS
// https://www.slimframework.com/docs/cookbook/enable-cors.html
$app->options('/{routes:.+}', function ($request, $response, $args) {
	return $response;
});

$app->add(function ($req, $res, $next) {
	$response = $next($req, $res);
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept')
		->withHeader('Access-Control-Allow-Methods', 'GET, POST, PATCH, DELETE');
});

// Routes
$app->group('/todo', function () {

	// List
	$this->get('[/]', function ($request, $response, $args) {

		try {

			$todo = new \Lagan\Model\Todo;
			$beans = $todo->read();

			$return = [];
			foreach ($beans as $bean) {
				$return[] = formatTodo($bean);
			}

			return $response->withJson( $return, 200 );

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

	// Existing bean
	$this->get('/{slug}', function ($request, $response, $args) {

		try {

			$todo = new \Lagan\Model\Todo;
			$bean = $todo->read( $args['slug'], 'slug' );

			return $response->withJson( formatTodo( $bean ), 200 );

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

	// Add
	$this->post('[/]', function ($request, $response, $args) {
		try {

			$todo = new \Lagan\Model\Todo;
			$input = $request->getParsedBody();

			// Rename key
			if ( $input['order']  ) {
				$input['position'] = $input['order'];
				unset( $input['order'] );
			}

			$bean = $todo->create( $input );

			return $response->withJson( formatTodo( $bean ), 200 );

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

	// Update
	$this->patch('/{slug}', function ($request, $response, $args) {
		try {

			$todo = new \Lagan\Model\Todo;
			$bean = $todo->read( $args['slug'], 'slug' );
			$input = $request->getParsedBody();

			// Rename key
			if ( $input['order'] ) {
				$input['position'] = $input['order'];
				unset( $input['order'] );
			}

			$bean = $todo->update( $input , $bean->id );

			return $response->withJson( formatTodo( $bean ), 200 );

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

	// Delete all beans
	$this->delete('[/]', function ($request, $response, $args) {
		try {

			$todo = new \Lagan\Model\Todo;
			$beans = $todo->read();

			foreach ($beans as $bean) {
				$todo->delete( $bean->id );
			}

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

	// Delete single bean
	$this->delete('/{slug}', function ($request, $response, $args) {
		try {

			$todo = new \Lagan\Model\Todo;
			$bean = $todo->read( $args['slug'], 'slug' );
			$todo->delete( $bean->id );

		} catch (Exception $e) {

			// Error
			return $response->withJson( [ 'error' => $e->getMessage() ], 400 );

		}
	});

});

?>