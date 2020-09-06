package com.example.testiology;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class Result extends AppCompatActivity {

    String flag="";
    String devicetoken,userid,userid1,uname,correctans;
    EditText e1,e2,e3;
    TextView t1,t2,t3,t4,t5;
    Button b1;
    ImageView i1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_result);

        e1=findViewById(R.id.edittext1);
        e2=findViewById(R.id.edittext2);
        e3=findViewById(R.id.edittext3);
        t1=findViewById(R.id.textView1);
        t2=findViewById(R.id.textView2);
        t3=findViewById(R.id.textView3);
        t4=findViewById(R.id.textView4);
        t5=findViewById(R.id.textView5);
        i1=findViewById(R.id.imageView1);

        FirebaseInstanceId.getInstance().getInstanceId().   addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                devicetoken = instanceIdResult.getToken();
            }
        });

        flag = getIntent().getExtras().getString("Flag");
        answer();

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.result, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.

           int id = item.getItemId();

          if(id == R.id.send)
          {
              answer1();
          }
        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }
    public void answer()
    {
        String url;
        url = constants.gettoken + devicetoken;
        StringRequest stringrequest1 = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            JSONObject jo = result.getJSONObject(0);
                            userid = jo.getString("userid");
                        }
                        catch(JSONException e) {
                            e.printStackTrace();
                        }
                        result();

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Sorry Some Error occured !!!", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                return params;
            }
        };
        RequestQueue requestQueue1 = Volley.newRequestQueue(getApplicationContext());
        requestQueue1.add(stringrequest1);
    }

    public void answer1()
    {
        String url;
        url = constants.gettoken + devicetoken;
        StringRequest stringrequest1 = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            JSONObject jo = result.getJSONObject(0);
                            userid1 = jo.getString("userid");
                        }
                        catch(JSONException e) {
                            e.printStackTrace();
                        }
                        uname();

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Sorry Some Error occured !!!", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                return params;
            }
        };
        RequestQueue requestQueue1 = Volley.newRequestQueue(getApplicationContext());
        requestQueue1.add(stringrequest1);
    }

    public void uname()
    {
        String url;
        url = constants.getuname + userid1;
        StringRequest stringrequest1 = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            JSONObject jo = result.getJSONObject(0);
                            uname = jo.getString("uname");
                        }
                        catch(JSONException e) {
                            e.printStackTrace();
                        }
                        result();
                        Intent in = new Intent(Result.this,homepage.class);
                        in.putExtra("UName",uname);
                        startActivity(in);

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Sorry Some Error occured !!!", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                return params;
            }
        };
        RequestQueue requestQueue1 = Volley.newRequestQueue(getApplicationContext());
        requestQueue1.add(stringrequest1);
    }

    public void result()
    {
        if(flag.equals("1"))
        {
            e1.setVisibility(View.INVISIBLE);
            e2.setVisibility(View.INVISIBLE);
            e3.setVisibility(View.INVISIBLE);
            t2.setVisibility(View.INVISIBLE);
            t3.setVisibility(View.INVISIBLE);
            t4.setVisibility(View.INVISIBLE);
            t5.setVisibility(View.INVISIBLE);

            i1.setVisibility(View.VISIBLE);
            t1.setVisibility(View.VISIBLE);

        }
        else if(flag.equals("2"))
        {

            e1.setVisibility(View.VISIBLE);
            e2.setVisibility(View.VISIBLE);
            e3.setVisibility(View.VISIBLE);
            t2.setVisibility(View.VISIBLE);
            t3.setVisibility(View.VISIBLE);
            t4.setVisibility(View.VISIBLE);
            t5.setVisibility(View.VISIBLE);

            i1.setVisibility(View.INVISIBLE);
            t1.setVisibility(View.INVISIBLE);

            String url = constants.report;
            StringRequest stringrequest = new StringRequest(url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                                JSONObject jo = result.getJSONObject(0);
                                uname=jo.getString("UName");
                                correctans=jo.getString("correctAns");

                            }
                            catch(JSONException e)
                            {
                                e.printStackTrace();
                            }

                            t5.setText("Result Declared");
                            t2.setText("Top Scorer : ");
                            e1.setText(uname);
                            t3.setText("Top Score : ");
                            e2.setText(correctans);

                            result1();
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), "Sorry Some Error occured !!!", Toast.LENGTH_SHORT).show();
                        }
                    }) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    return params;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringrequest);
        }
    }

    public void result1()
    {
        String url = constants.report1 + userid;
        StringRequest stringrequest = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            JSONObject jo = result.getJSONObject(0);
                            correctans=jo.getString("correctAns");

                        }
                        catch(JSONException e)
                        {
                            e.printStackTrace();
                        }

                        t4.setText("Your Score : ");
                        e3.setText(correctans);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Sorry Some Error occured !!!", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringrequest);
    }

    @Override
    public void onBackPressed() {
        //   super.onBackPressed();
    }

}
