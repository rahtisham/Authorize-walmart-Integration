<?php

namespace App\Http\Controllers\MarketPlace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalmartMarketPlace;
use App\Models\Walmart\ItemsManager;
use Illuminate\Support\Facades\Validator;

class MarketPlaceController extends Controller
{
    public function index()
    {
        $user_session_id = auth()->user()->id;
        $marketPlace = WalmartMarketPlace::where('user_id' , $user_session_id)->get();
        return view('marketplace.index' , ['marketPlace' => $marketPlace]);
    }
    public function plateForm()
    {
        return view('marketplace.plateform');
    }
    public function walmartRegister()
    {
        return view('marketplace.register-walmart');
    }
    public function walmartIntegration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'clientName' => 'required|alpha',
            'clientID' => 'required',
            'clientSecretID' => 'required',
        ],
            [
                'clientName.required' => 'Client name is required',
                'clientID.required' => 'Client Id is required',
                'clientSecretID.required' => 'Secret Id is required',
            ]
            );

        if ($validator->fails()) {
            return redirect('dashboard/marketplace/walmart')
                ->withErrors($validator)
                ->withInput();
        }
        $uses_session_id = auth()->user()->id;

        $client_id = $request->get('clientID');
        $secret = $request->get('clientSecretID');


        $uses_session_id = auth()->user()->id;
        $marketPlace = WalmartMarketPlace::where('user_id' , $uses_session_id)->get();

        if(count($marketPlace) > 0)
        {
            $token = $this->tokenGenenrate($client_id, $secret);

            if($token){
                $integration = [

                    'name' => $request->get('clientName'),
                    'client_id'      => $request->get('clientID'),
                    'client_secret'  => $request->get('clientSecretID'),
                    'status'  => "active",
                    'token'  => "test",
                    'is_active'  =>  '0',
                    'platform'  => "Walmart",
                    'user_id' => $uses_session_id

                ];
                $market = WalmartMarketPlace::updateWalmartStore($integration, $marketPlace[0]->id);

                return redirect('dashboard/marketplace/walmart')->with(['success' => 'Walmart Market Place Has Been Updated Successfully.']);

            }else{

                return redirect('dashboard/marketplace/walmart')->with(['error' => 'Invalid Walmart Credentials']);
            }
        }
        else
        {
            $token = $this->tokenGenenrate($client_id, $secret);

            if($token){
                $integration = [

                    'name' => $request->get('clientName'),
                    'client_id'      => $request->get('clientID'),
                    'client_secret'  => $request->get('clientSecretID'),
                    'status'  => "active",
                    'token'  => "test",
                    'is_active'  =>  '0',
                    'platform'  => "Walmart",
                    'user_id' => $uses_session_id

                ];
                $market = WalmartMarketPlace::createWalmartStore($integration);

                $test = ItemsManager::create_manager($market->id);

                return redirect('dashboard/marketplace/walmart')->with(['success' => 'Walmart Market Place Has Been Registered Successfully.']);

            }else{

                return redirect('dashboard/marketplace/walmart')->with(['error' => 'Invalid Walmart Credentials']);
            }


        }



//            return response()->json(['success'=>
//                ' <div class="alert alert-primary alert-dismissible fade show">
//                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
//                <strong>Welcome!</strong> Data Has Been Submited Successfully....
//                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
//                </button>
//                </div>'
//            ]);
//
//
//
//

    }


    public function tokenGenenrate($client_id, $secret)
    {
        $url = "https://marketplace.walmartapis.com/v3/token";
        $uniqid = uniqid();
        $authorization_key = base64_encode($client_id.":".$secret);


        $ch = curl_init();
        $options = array(

            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HEADER => false,
            CURLOPT_POST =>1,
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(

                "WM_SVC.NAME: Walmart Marketplace",
                "WM_QOS.CORRELATION_ID: $uniqid",
                "Authorization: Basic $authorization_key",
                "Accept: application/json",
                "Content-Type: application/x-www-form-urlencoded",
            ),
        );
        curl_setopt_array($ch,$options);


        $response = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        curl_close($ch);


        if($code == 201 || $code == 200) {
            $token = json_decode($response, true);
            return $token['access_token'];
        }

    }
}
