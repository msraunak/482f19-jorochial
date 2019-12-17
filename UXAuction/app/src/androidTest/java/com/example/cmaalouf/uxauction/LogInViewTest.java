package com.example.cmaalouf.uxauction;


import com.example.cmaalouf.uxauction.MainActivity;
import com.example.cmaalouf.uxauction.R;
import org.junit.Rule;
import org.junit.Test;
import org.junit.runner.RunWith;
import androidx.test.rule.ActivityTestRule;
import static android.support.test.espresso.Espresso.onView;
import static android.support.test.espresso.action.ViewActions.click;
import static android.support.test.espresso.assertion.ViewAssertions.matches;
import static android.support.test.espresso.matcher.ViewMatchers.isDisplayed;
import static android.support.test.espresso.matcher.ViewMatchers.withId;
import static androidx.test.espresso.matcher.ViewMatchers.withText;


public class LogInViewTest
{
    @Rule
    public ActivityTestRule<MainActivity> loginActivityRule = new ActivityTestRule<>(MainActivity.class);

    @Test
    public void testTextViews()
    {

        onView(withId(R.id.login)).check(matches(withText("Login")));
    }

}

