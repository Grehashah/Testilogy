package com.example.testiology;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import com.google.android.gms.ads.MobileAds;
import com.google.android.gms.ads.initialization.InitializationStatus;
import com.google.android.gms.ads.initialization.OnInitializationCompleteListener;

public class feedbackfragment extends Fragment {
    EditText email,cmt;
    RadioGroup rd1;
    RadioButton rdb1,rdb2,rdb3;
    String strtext="";
    String email1,choice1="",cmt1;
    AdView a1;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        strtext = getArguments().getString("UName");

        return inflater.inflate(R.layout.fragment_feedback,null);

    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        setHasOptionsMenu(true);

        cmt=view.findViewById(R.id.cmt1);
        rdb1=view.findViewById(R.id.radioButton1);
        rdb2=view.findViewById(R.id.radioButton2);
        rdb3=view.findViewById(R.id.radioButton3);
        a1=view.findViewById(R.id.adView1);

        //Mobile Ads
        MobileAds.initialize(getActivity(), new OnInitializationCompleteListener() {
            @Override
            public void onInitializationComplete(InitializationStatus initializationStatus) {
            }
        });

        AdRequest adRequest=new AdRequest.Builder().build();
        a1.loadAd(adRequest);
    }

    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater1) {

        //  inflater1 = getActivity().getMenuInflater();
        inflater1.inflate(R.menu.feedback_menu,menu);
        // super.onCreateOptionsMenu(menu, inflater);
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id=item.getItemId();

        if(id == R.id.send)
        {
            cmt1=cmt.getText().toString();
            if(rdb1.isChecked())
            {
                choice1="Good";
            }
            else if(rdb2.isChecked())
            {
                choice1="Better";
            }
            else if(rdb1.isChecked())
            {
                choice1="Best";
            }
            else
            {

            }

                getemail();
           }
        return super.onOptionsItemSelected(item);

    }


    public void getemail()
    {
        if(choice1.equals(""))
        {
            Toast.makeText(getActivity(), "Any One of them Must be Selected", Toast.LENGTH_SHORT).show();
        }
        else if(cmt1.equals(""))
        {
            Toast.makeText(getActivity(), "Please Enter any Comments", Toast.LENGTH_SHORT).show();
        }
        else {

            String url = constants.showuser + strtext;
            StringRequest stringrequest = new StringRequest(url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                                JSONObject jo = result.getJSONObject(0);
                                email1 = jo.getString("Email");
                                setdata();

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {

                            Toast.makeText(getActivity(), "Error occured", Toast.LENGTH_SHORT).show();
                        }
                    }) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    return params;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
            requestQueue.add(stringrequest);
        }
    }

    public void setdata()
    {
        StringRequest stringrequest = new StringRequest(Request.Method.POST,
                constants.feedback,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        try {
                            JSONObject jsonobject = new JSONObject(response);
                            String error1 = jsonobject.getString("error");

                            if (error1.equals("false")) {
                                Toast.makeText(getActivity(), jsonobject.getString("message"), Toast.LENGTH_SHORT).show();
                            } else {
                                Toast.makeText(getActivity(), jsonobject.getString("message"), Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                        Toast.makeText(getActivity(), "Error occured", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("Email", email1);
                params.put("Choice", choice1);
                params.put("Cmt",cmt1);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
        requestQueue.add(stringrequest);
    }

}
