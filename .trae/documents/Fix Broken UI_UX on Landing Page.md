I will improve the UI/UX of the landing page to fix the broken layout and modernize the design.

**Changes Plan:**

1.  **Fix Hero Section (Top Banner)**
    -   **Problem**: The current background image contains text ("Laboratory Teknik") that gets cut off by the diagonal layout design, making it look broken ("g jelas").
    -   **Solution**: Replace the placeholder image with a clean, text-free version or one with centered, short text.
    -   **Action**: Update the `img src` in `welcome.blade.php` to a cleaner placeholder URL (e.g., without text or with a simple "Lab" label) so it doesn't clash with the foreground content.

2.  **Enhance Features Section**
    -   **Problem**: The features are listed as simple text with icons, which looks a bit plain and "unclear" in terms of hierarchy.
    -   **Solution**: Convert the feature list into a **Card Layout**.
    -   **Action**:
        -   Wrap each feature item in a white card container.
        -   Add `shadow`, `rounded-lg` borders, and `hover` effects.
        -   Add padding (`p-6`) to make the content breathe.

3.  **General Polish**
    -   Adjust spacing in the hero text to ensure the main title "Sistem Manajemen..." is clearly readable and not cramped.
    -   Ensure the "Call to Action" buttons (Login/Register) have clear visual weight.

**File to Edit**: `resources/views/welcome.blade.php`
