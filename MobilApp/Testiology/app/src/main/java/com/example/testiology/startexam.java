package com.example.testiology;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
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

public class startexam extends AppCompatActivity {

    RadioGroup rg;
    RadioButton a,b,c,d;
    String qpid="";
    String option1,option2,option3,option4;
    String ans,qid,devicetoken,userid;
    Button b1;

    @Override
    public void onBackPressed() {
     //   super.onBackPressed();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_startexam);

        b1=findViewById(R.id.button1);
        a=findViewById(R.id.radioButton1);
        b=findViewById(R.id.radioButton2);
        c=findViewById(R.id.radioButton3);
        d=findViewById(R.id.radioButton4);

        FirebaseInstanceId.getInstance().getInstanceId().   addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                devicetoken = instanceIdResult.getToken();
            }
        });

        qpid = getIntent().getExtras().getString("qpid");
        String url = constants.getoptions + qpid;

            StringRequest stringrequest = new StringRequest(url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                                JSONObject jo = result.getJSONObject(0);
                                option1 = jo.getString("option1");
                                option2 = jo.getString("option2");
                                option3 = jo.getString("option3");
                                option4 = jo.getString("option4");
                                qid = jo.getString("qid");


                                }
                            catch(JSONException e)
                            {
                                e.printStackTrace();
                            }

                            a.setText(option1);
                            b.setText(option2);
                            c.setText(option3);
                            d.setText(option4);
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

            b1.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    if(a.isChecked())
                    {
                        ans=a.getText().toString();
                    }
                    else if(b.isChecked())
                    {
                        ans=b.getText().toString();
                    }
                    else if(c.isChecked())
                    {
                        ans=c.getText().toString();
                    }
                    else if(d.isChecked())
                    {
                        ans=d.getText().toString();
                    }
                    else
                    {
                        ans = "";
                    }
                    answer();
                }
            });
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
                            catch(JSONException e)
                            {
                                e.printStackTrace();
                            }

                            useranswer();
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
        public void useranswer()
        {
            b1.setEnabled(false);
            StringRequest stringrequest = new StringRequest(Request.Method.POST,constants.answer,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            try {
                                JSONObject jsonObject = new JSONObject(response);

                                String error = jsonObject.getString("error");

                                // Checking for Correct Username and Password
                                if(error.equals("false"))
                                {
                                    Toast.makeText(getApplicationContext(), "Your Answer is submitted Successfully", Toast.LENGTH_SHORT).show();
                                }
                                else
                                {
                                    Toast.makeText(getApplicationContext(), "Please Try Again", Toast.LENGTH_SHORT).show();
                                }

                            }
                            catch(JSONException e)
                            {
                                e.printStackTrace();
                            }
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
                    params.put("Ans",ans);
                    params.put("QId",qid);
                    params.put("UserId",userid);
                    return params;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringrequest);
        }
}

