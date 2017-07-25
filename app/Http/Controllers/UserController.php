<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder
            ->setBody('Hello world');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $token = App\User::find(2)->getAttribute("token");

        $downstreamResponse = FCM::sendTo($token, $option, $notification);

//        return compact($downstreamResponse);
        return "Success: ".$downstreamResponse->numberSuccess()."<br>"."Failure: ".$downstreamResponse->numberFailure()."<br>"."Modif: ".$downstreamResponse->numberModification()."<br>";

//        $downstreamResponse->numberSuccess();
//        $downstreamResponse->numberFailure();
//        $downstreamResponse->numberModification();

//        $users = App\User::find(2)->getAttribute("token");
//        return view('notification', compact($users));
//        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = DB::table('users')->insertGetId([
            'name'      => $request->get("name"),
            'email'     => $request->get("email"),
            'password'  => $request->get("password"),
            'token'     => $request->get("token"),
        ]);

        return $userID;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
