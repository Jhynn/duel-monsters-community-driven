<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ServiceInterface
{
	/**
     * Return the listing of the resource from the DB.
     *
	 * @param Request $properties 
	 * @return mixed 
	 */
	public function index(Request $properties);

	/**
     * Stores the brand new resource in the DB.
     * 
	 * @param array $properties 
	 * @return mixed 
	 */
	public function store(array $properties);

	/**
     * Retrieves the specified resource from the DB.
     * 
	 * @param int $id 
	 * @param array $relations
	 * @return mixed 
	 */
	public function show(int $id, array $relations);

	/**
     * Updates the specified resource with $properties in the DB.
     * 
	 * @param array $properties 
	 * @param int $id 
	 * @return mixed 
	 */
	public function update(array $properties, int $id);

	/**
     * Deletes the specified resource from the DB.
     * 
	 * @param int $id 
	 * @param array $aux some extra needed information.
	 * @return mixed 
	 */
	public function destroy(int $id, array $aux=null);
}
