package com.example.testiology;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class historyfragment extends Fragment {

    String strtext="";
    ListView l1;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        strtext = getArguments().getString("UName");

        return inflater.inflate(R.layout.fragment_history,null);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        setHasOptionsMenu(true);

        l1=view.findViewById(R.id.listview1);
        showdata();
    }

    public void showdata() {

        String url = constants.examhistory + strtext;

        StringRequest stringRequest = new StringRequest(url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        ArrayList<HashMap<String,String>> list = new ArrayList<HashMap<String,String>>();
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            JSONArray result = jsonObject.getJSONArray(constants.jsonarray);

                            for(int i=0;i<result.length();i++) {
                                JSONObject jo = result.getJSONObject(i);
                                String subject = jo.getString("Subject");
                                String doc = jo.getString("Doc");
                                String place = jo.getString("Place");

                                final HashMap<String, String> params = new HashMap<>();
                                params.put("Subject",subject);
                                params.put("Doc",doc);
                                params.put("Place", place);
                                list.add(params);
                            }

                        }
                        catch(JSONException e)
                        {
                            e.printStackTrace();
                        }

                        ListAdapter adapter = new SimpleAdapter(getActivity(),list,R.layout.mylist,new String[]{"Subject","Doc","Place"},new int[]{R.id.subject1,R.id.doc1,R.id.place1});

                        l1.setAdapter(adapter);
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
