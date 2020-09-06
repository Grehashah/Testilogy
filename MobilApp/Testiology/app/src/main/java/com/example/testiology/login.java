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
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class login extends AppCompatActivity
{
    EditText pswd,usrusr;
    TextView sup;
    Button lin;
    String uname1,pwd1;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        lin = (Button) findViewById(R.id.lin);
        usrusr = (EditText) findViewById(R.id.usrusr);
        pswd = (EditText) findViewById(R.id.pswrdd);
        sup = (TextView) findViewById(R.id.sup);

        //Getting UName

        lin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                uname1 = usrusr.getText().toString().trim();
                pwd1 = pswd.getText().toString().trim();
                UserLogin();
            }
        });
        sup.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                Intent it = new Intent(login.this, signup.class);
                startActivity(it);
            }
        });
    }

    private void UserLogin()
    {
        if(uname1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Username", Toast.LENGTH_SHORT).show();
        }
        else if(pwd1.equals(""))
        {
            Toast.makeText(getApplicationContext(), "Please Enter Password", Toast.LENGTH_SHORT).show();
        }
        else {

            StringRequest stringrequest = new StringRequest(Request.Method.POST,
                    constants.UserLogin,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {

                                JSONObject jsonObject = new JSONObject(response);
                                String error = jsonObject.getString("error");

                                // Checking for Correct Username and Password
                                if(error.equals("false"))
                                {
                                    Intent it = new Intent(login.this, homepage.class);
                                    it.putExtra("UName", usrusr.getText().toString()); // getText() SHOULD NOT be static!!!
                                    startActivity(it);
                                }
                                else
                                {
                                    Toast.makeText(getApplicationContext(), "Wrong Username Or Password", Toast.LENGTH_SHORT).show();
                                }
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                        }
                    },

                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), "Error Occured Please Try Again!!!", Toast.LENGTH_SHORT).show();
                        }
                    }) {

                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("UName", uname1);
                    params.put("Pass", pwd1);
                    return params;
                }
            };
            RequestQueue requestqueue = Volley.newRequestQueue(this);
            requestqueue.add(stringrequest);
        }
    }
}
