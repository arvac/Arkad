package com.example.iris.myapplication;



import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.content.Intent;
import android.view.View;
import android.widget.Button;
import java.util.ArrayList;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    ArrayList<String> rssLinks = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button btnRediff = findViewById(R.id.btnRediff);
        Button btnCinemaBlend = findViewById(R.id.btnCinemaBlend);
        btnRediff.setOnClickListener(this);
        btnCinemaBlend.setOnClickListener(this);
        rssLinks.add("http://www.rediff.com/rss/moviesreviewsrss.xml");
        rssLinks.add("http://www.cinemablend.com/rss_review.php");
    }

    @Override
    public void onClick(View view) {
        Intent intent = new Intent(getApplicationContext(), RSSFeedActivity.class);
        switch (view.getId()) {
            case R.id.btnRediff:
                intent.putExtra("rssLink", rssLinks.get(0));
                startActivity(intent);
                break;
            case R.id.btnCinemaBlend:
                intent.putExtra("rssLink", rssLinks.get(1));
                startActivity(intent);
                break;
        }
    }
}