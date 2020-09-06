package com.example.testiology;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class signup extends AppCompatActivity
{
    EditText mail,mophone,pswd,usrusr,qual;
    TextView lin;
    Button sup1;
    String qual1,uname1,pwd1,mail1,mo1,error1;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        sup1 = (Button) findViewById(R.id.sup);
        lin = (TextView) findViewById(R.id.lin);
        usrusr = (EditText) findViewById(R.id.usrusr);
        pswd = (EditText) findViewById(R.id.pswrdd);
        mail = (EditText) findViewById(R.id.mail);
        mophone = (EditText) findViewById(R.id.mobphone);
        qual = (EditText) findViewById(R.id.qual);

        lin.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                Intent it = new Intent(signup.this,login.class);
                startActivity(it);
            }
        });

        sup1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                qual1 = qual.getText().toString();
                uname1 = usrusr.getText().toString();
                pwd1 = pswd.getText().toString();
                mail1 = mail.getText().toString();
                mo1 = mophone.getText().toString();

                useregister();
            }
        });
    }

    public void useregister()
    {

        if(mail1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Email Address", Toast.LENGTH_SHORT).show();
        }
        else if(uname1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Username", Toast.LENGTH_SHORT).show();
        }
        else if(pwd1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Password", Toast.LENGTH_SHORT).show();
        }
        else if(pwd1.length() !=  8)
        {
            Toast.makeText(getApplicationContext(), "Password must be of 8 Characters", Toast.LENGTH_SHORT).show();
        }
        else if(mo1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Mobile Number", Toast.LENGTH_SHORT).show();
        }
        else if(mo1.length() != 10)
        {
            Toast.makeText(getApplicationContext(), "Wrong Mobile Number", Toast.LENGTH_SHORT).show();
        }
        else if(qual1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter your Qualification", Toast.LENGTH_SHORT).show();
        }
        else {

            StringRequest stringRequest1 = new StringRequest(Request.Method.POST, constants.checkuser,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            try {
                                JSONObject jsonObject = new JSONObject(response);

                                error1 = jsonObject.getString("error");

                                if(error1.equals("false"))
                                {
                                    finalRegistration();
                                }
                                else
                                {
                                    Toast.makeText(getApplicationContext(), "Entered username is already Registered! Please use Another One!!!", Toast.LENGTH_SHORT).show();
                                }

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), "Error Occured Please Try Again !!!", Toast.LENGTH_SHORT).show();
                        }
                    }
            ) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("UName", uname1);
                    return params;
                }
            };


            RequestQueue requestQueue = Volley.newRequestQueue(this);
            requestQueue.add(stringRequest1);
        }
    }

    public void finalRegistration() {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, constants.UserRegister,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            String error = jsonObject.getString("error");

                            if (error.equals("false")) {
                                Toast.makeText(getApplicationContext(), "Registration Done Successfully !!!", Toast.LENGTH_SHORT).show();
                                Intent it = new Intent(signup.this, login.class);
                                startActivity(it);
                            } else {
                                Toast.makeText(getApplicationContext(), "Error Occured Please Try Again !!!", Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Error Occured Please Try Again!!!", Toast.LENGTH_SHORT).show();
                    }
                }
        ) {

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String, String> params = new HashMap<>();

                params.put("UName", uname1);
                params.put("Pass", pwd1);
                params.put("ContactNo", mo1);
                params.put("Email", mail1);
                params.put("Qual", qual1);

                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
