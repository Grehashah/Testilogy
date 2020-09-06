package com.example.testiology;

import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.HashMap;
import java.util.Map;

public class MyFirebaseMessagingService extends FirebaseMessagingService
{
    String msg="";
    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {
        msg = remoteMessage.getData().get("message");
       showmsg();
    }

    public void showmsg()
    {
        if(msg.equals("endexam"))
        {
            Intent notificationIntent = new Intent(getApplicationContext(),Result.class);
            notificationIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            notificationIntent.putExtra("Flag","1");
            startActivity(notificationIntent);
        }
        else if(msg.equals("sorry"))
        {
            Intent notificationIntent = new Intent(getApplicationContext(),login.class);
            notificationIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(notificationIntent);
        }
        else if(msg.equals("getresult"))
        {
            Intent notificationIntent = new Intent(getApplicationContext(),Result.class);
            notificationIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            notificationIntent.putExtra("Flag","2");
            startActivity(notificationIntent);
        }
        else
        {
            Intent notificationIntent = new Intent(getApplicationContext(),startexam.class);
            notificationIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            notificationIntent.putExtra("qpid",msg);
            startActivity(notificationIntent);
        }
    }


    @Override
    public void onNewToken(final String token) {
        StringRequest stringRequest1 = new StringRequest(Request.Method.POST, constants.regtoken,
            new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {

                    try {
                        JSONObject jsonObject = new JSONObject(response);

                        String error1 = jsonObject.getString("error");

                        if(error1.equals("false"))
                        {
    //                        Toast.makeText(getApplicationContext(), "Token Registred Successfully!!!", Toast.LENGTH_SHORT).show();
                        }
                        else
                        {
  //                          Toast.makeText(getApplicationContext(), "Error Occurred!!!", Toast.LENGTH_SHORT).show();
                        }

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
            },
            new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
//                    Toast.makeText(getApplicationContext(), "Error Occured Please Try Again !!!", Toast.LENGTH_SHORT).show();
                }
            }
    ) {
        @Override
        protected Map<String, String> getParams() throws AuthFailureError {
            Map<String, String> params = new HashMap<>();
            params.put("Token", token);
            return params;
        }
    };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest1);

    }
}
