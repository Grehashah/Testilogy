package com.example.testiology;

import android.content.Intent;
import android.os.Bundle;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import android.view.View;

import androidx.core.view.GravityCompat;
import androidx.appcompat.app.ActionBarDrawerToggle;

import android.view.MenuItem;

import com.google.android.material.navigation.NavigationView;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;

import androidx.drawerlayout.widget.DrawerLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.view.Menu;
import android.widget.Toast;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class homepage extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    String flag="";
    NavigationView navigationView;
    String passedUname="";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_homepage);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        navigationView=findViewById(R.id.nav_view);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        navigationView.setNavigationItemSelectedListener(this);

        //Getting UName
        passedUname = getIntent().getExtras().getString("UName");

        if(savedInstanceState == null)
        {
            examstate();
            navigationView.setCheckedItem(R.id.nav_home);
        }

        // Token Registration

        FirebaseInstanceId.getInstance().getInstanceId().   addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                final String deviceToken = instanceIdResult.getToken();

                StringRequest stringrequest = new StringRequest(Request.Method.POST,
                        constants.usertokenreg,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
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
                        params.put("UName", passedUname);
                        params.put("Token", deviceToken);
                        return params;
                    }
                };
                RequestQueue requestqueue = Volley.newRequestQueue(getApplicationContext());
                requestqueue.add(stringrequest);
            }
        });
    }

    public void examstate()
    {

        StringRequest stringrequest = new StringRequest(
                constants.examstate,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonObject = new JSONObject(response);
                            String error = jsonObject.getString("error");

                            // Checking for Correct Username and Password
                            if(error.equals("false"))
                            {
                                flag="1";
                                Fragment fragment = null;
                                Bundle bundle = new Bundle();
                                bundle.putString("Flag", flag);
                                bundle.putString("UName", passedUname);
                                fragment = new homefragment();
                                fragment.setArguments(bundle);

                                replaceFragment(fragment);
                            }
                            else
                            {
                                flag="0";
                                Fragment fragment = null;
                                Bundle bundle = new Bundle();
                                bundle.putString("Flag", flag);
                                bundle.putString("UName", passedUname);
                                fragment = new homefragment();
                                fragment.setArguments(bundle);

                                replaceFragment(fragment);
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
                return params;
            }
        };
        RequestQueue requestqueue = Volley.newRequestQueue(this);
        requestqueue.add(stringrequest);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
       //getMenuInflater().inflate(R.menu.profile_menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.

           /*int id = item.getItemId();

          if(id == R.id.update)
          {
              Toast.makeText(getApplicationContext(),"Update",Toast.LENGTH_SHORT).show();
          }*/
        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }

    private void replaceFragment(Fragment fragment){
        getSupportFragmentManager().beginTransaction().replace(R.id.screen_layout, fragment)
                .addToBackStack(null).commit();
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        Fragment fragment = null;


        int id = item.getItemId();

        if (id == R.id.nav_home) {

            navigationView.setCheckedItem(R.id.nav_home);

            StringRequest stringrequest = new StringRequest(
                    constants.examstate,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {

                                JSONObject jsonObject = new JSONObject(response);
                                String error = jsonObject.getString("error");

                                // Checking for Correct Username and Password
                                if(error.equals("false"))
                                {
                                    flag="1";
                                    Fragment fragment = null;
                                    Bundle bundle = new Bundle();
                                    bundle.putString("Flag", flag);
                                    bundle.putString("UName", passedUname);
                                    fragment = new homefragment();
                                    fragment.setArguments(bundle);
                                    replaceFragment(fragment);
                                }
                                else
                                {
                                    flag="0";
                                    Fragment fragment = null;
                                    Bundle bundle = new Bundle();
                                    bundle.putString("Flag", flag);
                                    bundle.putString("UName", passedUname);
                                    fragment = new homefragment();
                                    fragment.setArguments(bundle);
                                    replaceFragment(fragment);
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
                    return params;
                }
            };
            RequestQueue requestqueue = Volley.newRequestQueue(this);
            requestqueue.add(stringrequest);

        }
        else if(id == R.id.nav_history)
        {
            Bundle bundle = new Bundle();
            bundle.putString("UName", passedUname);
            // set Fragmentclass Arguments
            fragment = new historyfragment();
            fragment.setArguments(bundle);
            replaceFragment(fragment);
            navigationView.setCheckedItem(R.id.nav_history);
        }
        else if(id == R.id.nav_myprofile)
        {
            Bundle bundle = new Bundle();
            bundle.putString("UName", passedUname);
            // set Fragmentclass Arguments
            fragment = new profilefragment();
            fragment.setArguments(bundle);

            replaceFragment(fragment);

           navigationView.setCheckedItem(R.id.nav_myprofile);
        }
        else if (id == R.id.nav_logout) {

            StringRequest stringrequest = new StringRequest(Request.Method.POST,
                    constants.logout,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {

                                JSONObject jsonObject = new JSONObject(response);
                                String error = jsonObject.getString("error");

                                // Checking for Correct Username and Password
                                if(error.equals("false"))
                                {
                                    Intent in = new Intent(homepage.this,login.class);
                                    startActivity(in);
                                }
                                else
                                {
                                    Toast.makeText(getApplicationContext(), "Error Occured Please Try Again", Toast.LENGTH_SHORT).show();
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
                    params.put("UName", passedUname);
                    return params;
                }
            };
            RequestQueue requestqueue = Volley.newRequestQueue(this);
            requestqueue.add(stringrequest);

        }
        else if(id == R.id.nav_contactus)
        {
            fragment = new contactusfragment();
            replaceFragment(fragment);
            navigationView.setCheckedItem(R.id.nav_contactus);
        }
        else if(id == R.id.nav_aboutUs)
        {
            fragment = new aboutusfragment();
            replaceFragment(fragment);
            navigationView.setCheckedItem(R.id.nav_aboutUs);
        }
        else if(id == R.id.nav_Feedback)
        {
            Bundle bundle = new Bundle();
            bundle.putString("UName", passedUname);
            // set Fragmentclass Arguments
            fragment = new feedbackfragment();
            fragment.setArguments(bundle);
            replaceFragment(fragment);
            navigationView.setCheckedItem(R.id.nav_Feedback);
        }

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
