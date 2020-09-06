package com.example.testiology;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;
import com.google.android.gms.ads.initialization.InitializationStatus;
import com.google.android.gms.ads.initialization.OnInitializationCompleteListener;
import com.google.zxing.integration.android.IntentIntegrator;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class homefragment extends Fragment {

    EditText t1,t2,t3;
    Button b1;
    AdView a1;


     static String sub1="",place1="",totalque1="";
     String id,Uname;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        id=getArguments().getString("Flag");
        Uname=getArguments().getString("UName");

        if(id.equals("1"))
        {
            return inflater.inflate(R.layout.fragment_home1,null);
        }
        else
        {
            return inflater.inflate(R.layout.fragment_home,null);
        }
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        setHasOptionsMenu(true);

        a1=view.findViewById(R.id.adView1);

        //Mobile Ads
        MobileAds.initialize(getActivity(), new OnInitializationCompleteListener() {
            @Override
            public void onInitializationComplete(InitializationStatus initializationStatus) {
            }
        });

        AdRequest adRequest=new AdRequest.Builder().build();
        a1.loadAd(adRequest);


        if(id.equals("1"))
        {
            t1=view.findViewById(R.id.edittext1);
            t2=view.findViewById(R.id.edittext2);
            t3=view.findViewById(R.id.edittext3);
            b1=view.findViewById(R.id.button1);

            setdata();

            b1.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                Intent intent = new Intent(getActivity(),scan_code.class);
                intent.putExtra("UName",Uname);
                startActivity(intent);
                }
            });
        }
        else
        {

        }
      }

      public void setdata()
      {
          StringRequest stringRequest = new StringRequest(constants.home1,
                  new Response.Listener<String>() {
                      @Override
                      public void onResponse(String response) {

                          try {
                              JSONObject jsonObject = new JSONObject(response);
                              JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                              JSONObject jo = result.getJSONObject(0);
                              sub1 = jo.getString("Subject");
                              place1 = jo.getString("Place");
                              totalque1 = jo.getString("TotalQue");
                          }
                          catch(JSONException e)
                          {
                              e.printStackTrace();
                          }

                          t1.setText(sub1);
                          t2.setText(place1);
                          t3.setText(totalque1);
                      }
                  },
                  new Response.ErrorListener() {
                      @Override
                      public void onErrorResponse(VolleyError error) {

                          Toast.makeText(getActivity(),"Error Occured",Toast.LENGTH_SHORT).show();
                      }
                  }){
              @Override
              protected Map<String, String> getParams() throws AuthFailureError {
                  Map<String,String> params = new HashMap<>();
                  return params;
              }
          };

          RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
          requestQueue.add(stringRequest);
      }
}
