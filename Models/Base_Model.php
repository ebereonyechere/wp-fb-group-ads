<?php


namespace Facebook_Group_Ads\Models;


class Base_Model {

	public $title;
	public $permalink;
	public $id;
	public $status;

	public function __construct( $id ) {
		$this->id        = $id;
		$this->title     = get_post( $id )->post_title;
		$this->permalink = get_permalink( $id );
		$this->status = get_post( $id )->post_status;
		
		$this->sync_meta_data();

	}

	/**
	 * Get a post meta associated with current model
	 *
	 * @param [string] $key
	 * @return string|int
	 * 
	 * @since 1.0.0
	 */
	public function get( $key ) {
		return get_post_meta( $this->id, $key, true );
	}

	/**
	 * Set a post meta associated with current model
	 *
	 * @param [string] $key
	 * @param [string|int] $value
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	public function set( $key, $value ) {
		return update_post_meta( $this->id, $key, $value );
	}

	/**
	 * Creates a model and inserts into the database
	 *
	 * @param [array] $args
	 * @return Base_Model
	 * 
	 * @since 1.0.0
	 */
	public static function create( $args, $meta_args = [] ) {
		$id = wp_insert_post( $args, false, false );
		$post = new self( $id );

		foreach( $meta_args as $key => $value) {
			$post->set( $key, $value );
		}

		return $post;
	}

	/**
	 * Returns all posts of the give post_type
	 *
	 * @param [string] $post_type
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	public static function all( $post_type ) {
		$posts = get_posts( [
            'numberposts' => -1,
            'post_type' => $post_type,
			'post_status' => [ 'publish', 'draft' ],
        ] );

		$data = [];

		foreach ( $posts as $post ) {
			array_push( $data, new self( $post->ID ) );
		}

		return $data;
	}

	/**
	 * Finds and returns a post with the given id
	 *
	 * @param [int] $id
	 * @return self
	 * 
	 * @since 1.0.0
	 */
	public static function find( $id ) {
		return new self( $id );
	}

	/**
	 * Delete the given post
	 *
	 * @param [int] $id
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	public function delete() {
		wp_delete_post( $this->id , true );
	}

	/**
	 * Deletes all posts of given post type
	 *
	 * @param [string] $post_type
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	public static function delete_all( $post_type ) {
		foreach( self::all( $post_type ) as $post ) {
			$post->delete();
		}
	}

	/**
	 * Syncs the curent posts meta data to the model's properties
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	public function sync_meta_data() {
		foreach ( get_post_meta( $this->id) as $key => $value ) {
			$this->$key = substr( $value[0], 0, 2 ) === "a:" ? get_post_meta( $this->id, $key )[0] : $value[0];
		}
	}

	public function update( $args ) {
		foreach ( $args as $key => $value ) {
			die($key);
			$this->set( $key, $value );
		}

		return $this;
	}

}
