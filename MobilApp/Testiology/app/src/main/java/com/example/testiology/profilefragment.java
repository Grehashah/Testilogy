package com.example.testiology;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
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
import com.google.android.gms.ads.initialization.InitializationStatus;
import com.google.android.gms.ads.initialization.OnInitializationCompleteListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class profilefragment extends Fragment
{

    EditText email,uname,passwd,mob,qual;
    String uname1="",pass1="",cno1="",email1 = "",qual1="";
    String uname2="",pass2="",cno2="",email2 = "",qual2="";

    String strtext="";
    AdView a1;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        strtext = getArguments().getString("UName");

        return inflater.inflate(R.layout.fragment_profile,null);

    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        setHasOptionsMenu(true);

        email=view.findViewById(R.id.edittext1);
        uname=view.findViewById(R.id.edittext2);
        passwd=view.findViewById(R.id.edittext3);
        mob=view.findViewById(R.id.edittext4);
        qual=view.findViewById(R.id.edittext5);

        a1=view.findViewById(R.id.adView1);

        //Mobile Ads
        MobileAds.initialize(getActivity(), new OnInitializationCompleteListener() {
            @Override
            public void onInitializationComplete(InitializationStatus initializationStatus) {
            }
        });

        AdRequest adRequest=new AdRequest.Builder().build();
        a1.loadAd(adRequest);


        uname.setText(strtext);

        setdata();
    }


    @Override
    public void onCreateOptionsMenu(Menu menu,MenuInflater inflater1) {

      //  inflater1 = getActivity().getMenuInflater();
        inflater1.inflate(R.menu.profile_menu,menu);
        // super.onCreateOptionsMenu(menu, inflater);
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.

        int id = item.getItemId();

        if(id == R.id.update)
        {
            updatedata();
        }
        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }


    public void updatedata()
    {
        uname2=uname.getText().toString();
        email2=email.getText().toString();
        pass2=passwd.getText().toString();
        cno2=mob.getText().toString();
        qual2=qual.getText().toString();

        if(email2.equals(""))
        {
            email.setText(email1);
            email2 = email1;
        }
        if(pass2.equals(""))
        {
            passwd.setText(pass1);
            pass2 = pass1;
        }
        if(pass2.length() !=  8)
        {
            Toast.makeText(getActivity(), "Password must be of 8 Characters", Toast.LENGTH_SHORT).show();
            pass2 = pass1;
       }
        if(cno2.equals(""))
        {
            mob.setText(cno1);
            cno2 = cno1;
        }
        if(cno2.length() != 10)
        {
            Toast.makeText(getActivity(), "Wrong Mobile Number", Toast.LENGTH_SHORT).show();
            cno2 = cno1;
        }
        if(qual2.equals(""))
        {
            qual2 = qual1;
        }
        else
        {
            StringRequest stringrequest = new StringRequest(Request.Method.POST,
                    constants.updateprofile,
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
                    params.put("UName", uname2);
                    params.put("Email", email2);
                    params.put("Pass", pass2);
                    params.put("Cno", cno2);
                    params.put("Qual", qual2);
                    return params;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
            requestQueue.add(stringrequest);
        }
    }
    public void setdata()
    {
        String url = constants.showuser + strtext;

        StringRequest stringRequest = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            JSONObject jo = result.getJSONObject(0);
                            uname1 = jo.getString("UName");
                            pass1 = jo.getString("Password");
                            cno1 = jo.getString("ContactNo");
                            email1=jo.getString("Email");
                            qual1=jo.getString("Qual");

                        }
                        catch(JSONException e)
                        {
                            e.printStackTrace();
                        }

                        email.setText(email1);
                        passwd.setText(pass1);
                        mob.setText(cno1);
                        qual.setText(qual1);
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
