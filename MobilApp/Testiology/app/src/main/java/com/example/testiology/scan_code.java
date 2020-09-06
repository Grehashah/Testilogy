package com.example.testiology;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
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
import com.google.zxing.Result;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import me.dm7.barcodescanner.zxing.ZXingScannerView;

public class scan_code extends AppCompatActivity
{
    Button b1;
    ImageView imageView;
    TextView textView;
    public static String deviceToken="";
    String uname="";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scan_code);

        b1 =findViewById(R.id.button1);
        imageView = findViewById(R.id.imageView1);
        textView = findViewById(R.id.text1);

        uname = getIntent().getExtras().getString("UName");

        FirebaseInstanceId.getInstance().getInstanceId().   addOnSuccessListener( new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                deviceToken = instanceIdResult.getToken();
            }
        });

        final Activity activity = this;
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                IntentIntegrator integrator = new IntentIntegrator(activity);
                integrator.setDesiredBarcodeFormats(IntentIntegrator.QR_CODE_TYPES);
                integrator.setPrompt("Scan");
                integrator.setCameraId(0);
                integrator.setBeepEnabled(false);
                integrator.setBarcodeImageEnabled(false);
                integrator.initiateScan();

            }
        });
    }

    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        final IntentResult result = IntentIntegrator.parseActivityResult(requestCode,resultCode,data);
        if(result != null)
        {
            if(result.getContents() == null)
            {
                Toast.makeText(this,"Scanning has been Cancelled",Toast.LENGTH_SHORT).show();
            }
            else
            {

                StringRequest stringRequest = new StringRequest(constants.geteid,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                String eid="";
                                try {

                                    JSONObject jsonObject = new JSONObject(response);
                                    JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                                    JSONObject jo = result.getJSONObject(0);
                                    eid = jo.getString("Eid");
                                }
                                catch(JSONException e)
                                {
                                    e.printStackTrace();
                                }

                                if(eid.equals(result.getContents()))
                                {
                                    StringRequest stringRequest2 = new StringRequest(Request.Method.POST, constants.userexamreg,
                                            new Response.Listener<String>() {
                                                @Override
                                                public void onResponse(String response) {

                                                }
                                            },
                                            new Response.ErrorListener() {
                                                @Override
                                                public void onErrorResponse(VolleyError error) {
                                                }
                                            }
                                    ) {
                                        @Override
                                        protected Map<String, String> getParams() throws AuthFailureError {
                                            Map<String, String> params = new HashMap<>();
                                            params.put("UName", uname);
                                            params.put("EId", result.getContents());
                                            return params;
                                        }
                                    };
                                    RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
                                    requestQueue.add(stringRequest2);


                                                StringRequest stringRequest1 = new StringRequest(Request.Method.POST, constants.readystate,
                                                        new Response.Listener<String>() {
                                                            @Override
                                                            public void onResponse(String response) {

                                                            }
                                                        },
                                                        new Response.ErrorListener() {
                                                            @Override
                                                            public void onErrorResponse(VolleyError error) {
                                                            }
                                                        }
                                                ) {
                                                    @Override
                                                    protected Map<String, String> getParams() throws AuthFailureError {
                                                        Map<String, String> params = new HashMap<>();
                                                        params.put("Token", deviceToken);
                                                        return params;
                                                    }
                                                };
                                                RequestQueue requestQueue1 = Volley.newRequestQueue(getApplicationContext());
                                                requestQueue1.add(stringRequest1);

                                    imageView.setImageResource(R.drawable.waiting);
                                    textView.setText("Wait for an exam to begin");
                                    b1.setEnabled(false);
                                }
                                else
                                {
                                    imageView.setImageResource(R.drawable.qr_wrong);
                                    textView.setText("Scanned Qr Code is Wrong!!!");
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {

                                Toast.makeText(getApplicationContext(),"Error Occured",Toast.LENGTH_SHORT).show();
                            }
                        }){
                    @Override
                    protected Map<String, String> getParams() throws AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        return params;
                    }
                };

                RequestQueue requestQueue = Volley.newRequestQueue(this);
                requestQueue.add(stringRequest);
            }
        }

        super.onActivityResult(requestCode, resultCode, data);
    }
}
