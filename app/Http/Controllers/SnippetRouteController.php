<?php


namespace App\Http\Controllers;


class SnippetRouteController extends Controller
{
    public function index(){
        return view('merchants.payment-route.snippets.index')->with([]);
    }

}