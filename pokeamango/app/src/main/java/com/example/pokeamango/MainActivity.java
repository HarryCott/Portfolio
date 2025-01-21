package com.example.pokeamango;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    private int mangoCount = 0;
    private int mangosPerClick = 1;
    private int upgradeCost = 10; // Initial cost of an upgrade
    private ImageView progressLayer;
    private TextView mangoCountText;
    private ImageButton mangoButton;
    private Button upgradeButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialize UI elements
        mangoCountText = findViewById(R.id.mangoCountText);
        mangoButton = findViewById(R.id.mangoButton);
        upgradeButton = findViewById(R.id.upgradeButton);
        progressLayer = findViewById(R.id.progressLayer);

        // Load the poke animation
        Animation pokeAnimation = AnimationUtils.loadAnimation(this, R.anim.poke_animation);

        // Handle mango clicks
        mangoButton.setOnClickListener(v -> {
            mangoCount += mangosPerClick;
            mangoCountText.setText("Mangos: " + mangoCount);
            updateProgressLayer(); // Update progress layer after each click

            // Start the poke animation
            mangoButton.startAnimation(pokeAnimation);
        });

        // Handle upgrades
        upgradeButton.setOnClickListener(v -> {
            if (mangoCount >= upgradeCost) {
                mangoCount -= upgradeCost;
                mangosPerClick++; // Increase mangos per click

                // Increment the cost of the next upgrade
                upgradeCost += upgradeCost / 2; // Example: Increase cost by 50%

                // Update the UI
                mangoCountText.setText("Mangos: " + mangoCount);
                upgradeButton.setText("Buy Upgrade (" + upgradeCost + " Mangos)");
                resetProgressLayer(); // Reset the progress layer after upgrade
            } else {
                Log.d("UpgradeButton", "Not enough mangos to upgrade.");
            }
        });

        // Initialize the upgrade button text
        upgradeButton.setText("Buy Upgrade (" + upgradeCost + " Mangos)");
    }

    // Function to update the progress layer dynamically based on mangoCount and upgradeCost
    private void updateProgressLayer() {
        // Calculate the progress as a percentage of the total height
        float progress = (float) mangoCount / upgradeCost;

        // Determine the height for the progress image based on the screen height
        int height = (int) (progress * getResources().getDisplayMetrics().heightPixels);

        // Update the height of the progress layer
        progressLayer.getLayoutParams().height = Math.min(height, getResources().getDisplayMetrics().heightPixels);
        progressLayer.requestLayout(); // Request layout update to reflect the height change
    }

    // Function to reset the progress layer height
    private void resetProgressLayer() {
        progressLayer.getLayoutParams().height = 0;
        progressLayer.requestLayout(); // Reset the progress layer height
    }

    @Override
    protected void onPause() {
        super.onPause();
        // Save progress
        SharedPreferences sharedPreferences = getSharedPreferences("MangoGame", MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt("mangoCount", mangoCount);
        editor.putInt("mangosPerClick", mangosPerClick);
        editor.putInt("upgradeCost", upgradeCost);
        editor.apply();
    }

    @Override
    protected void onResume() {
        super.onResume();
        // Load progress
        SharedPreferences sharedPreferences = getSharedPreferences("MangoGame", MODE_PRIVATE);
        mangoCount = sharedPreferences.getInt("mangoCount", 0);
        mangosPerClick = sharedPreferences.getInt("mangosPerClick", 1);
        upgradeCost = sharedPreferences.getInt("upgradeCost", 10);

        // Update UI with saved values
        mangoCountText.setText("Mangos: " + mangoCount);
        upgradeButton.setText("Buy Upgrade (" + upgradeCost + " Mangos)");

        // Update progress layer based on saved mangoCount
        updateProgressLayer();
    }
}
