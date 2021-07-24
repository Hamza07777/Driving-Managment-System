<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailclient;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $email = 'dev@softlinkage.net';

        $mailData = [
            'title' => 'Demo Email',
            'Description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec convallis faucibus justo. Maecenas pharetra nisi at tellus blandit hendrerit. Vivamus porta, leo vitae placerat egestas, nisi mi tempor quam, sed bibendum elit nulla vel urna. Aliquam non faucibus tortor. Aliquam ut augue lacinia massa ultrices ullamcorper. Nam scelerisque sollicitudin orci, quis consequat mauris dignissim sit amet. Maecenas feugiat interdum magna et imperdiet. Aliquam volutpat felis pretium, viverra justo quis, euismod lacus.',

            'url' => 'https://www.positronx.io'
        ];

       $result= Mail::to($email)->send(new Emailclient($mailData));


      if($result==null){
                    return redirect('/')->with('success','Mail Successfully Sent.');
                }
                else{
                    return redirect('/')->with('error','Mail Not Sent.');
                }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
