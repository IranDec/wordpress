### Language Selector Module Documentation  

This WordPress plugin provides a **Language Selector Modal** compatible with **WPML** and **Divi**. It allows users to select their preferred language for the website. Once a language is selected, the modal will no longer appear for that user. The selection is stored using cookies, and the user is redirected to the corresponding language-specific URL.

---

### **How It Works**

1. **Modal Display**:  
   - When the user visits the website for the first time, a modal pops up, prompting them to select their preferred language.  
   - The modal includes a list of available languages with corresponding flags and labels.  

2. **Language Selection**:  
   - Users can click on their desired language option.  
   - Once selected, the plugin sets the language cookie and redirects the user to the appropriate language-specific page using **WPML's URL structure** (e.g., `/en`, `/fa`, `/ar`).  

3. **Cookie Storage**:  
   - The selected language is saved in a cookie named `selected_language` with a default expiration period of 30 days.  
   - This ensures that the modal will not be displayed again to the same user during this period.  

4. **Redirection**:  
   - After selecting a language, the user is redirected to the corresponding language-specific URL.  
   - Redirection works seamlessly with **WPML's language switcher** to maintain compatibility.  

5. **Skip Modal for Returning Users**:  
   - On subsequent visits, if the cookie `selected_language` exists, the modal will not be displayed.  
   - This allows the user to directly access the website in their preferred language.  

---

### **Features**

1. **WPML Compatibility**:  
   - Fully integrates with **WPML**, utilizing its language URLs and switcher for multilingual sites.  

2. **Divi Theme Compatibility**:  
   - Designed to work smoothly with **Divi** and its custom layouts without breaking the site's design or functionality.  

3. **Automatic Language Detection**:  
   - The plugin automatically detects whether a language has been previously selected by checking the `selected_language` cookie.  

4. **Customizable Language List**:  
   - Languages and their flags can be modified dynamically in the PHP code.  
   - The list is rendered automatically in the modal.  

5. **Seamless User Experience**:  
   - If a language is selected, the modal is skipped on future visits.  
   - Redirection is handled efficiently to enhance usability.  

6. **AJAX Integration**:  
   - Uses AJAX to set the language cookie without reloading the page.  

7. **Responsive Design**:  
   - Fully responsive modal that adapts to different screen sizes, ensuring a consistent experience across devices.  

---

### **Code Structure**

1. **PHP Code**:  
   - Handles modal rendering, cookie management, WPML integration, and AJAX requests.  
   - Ensures the modal is not displayed if a cookie already exists.  

2. **JavaScript**:  
   - Manages the modal's behavior, including language selection, AJAX requests, and hiding the modal for returning users.  

3. **CSS**:  
   - Defines the modal's appearance and ensures it is visually appealing and responsive, even in Divi layouts.  

---

### **Installation**

1. Download the plugin files.  
2. Place the files in the `/wp-content/plugins/` directory of your WordPress installation.  
3. Activate the plugin through the WordPress admin panel.  
4. Ensure WPML is installed and configured properly to support multiple languages.  

---

### **Usage**

- The plugin automatically activates the modal on the website's front end.  
- No additional configuration is required unless you want to modify the language list.  

---

### **Customizations**

1. **Adding New Languages**:  
   - Open the PHP file and modify the `$languages` array to include new languages and their flags.  

2. **Cookie Expiration**:  
   - The cookie expiration period can be adjusted by changing the `time()` value in the `setcookie()` function.  

3. **Modal Styling**:  
   - Update the `style.css` file to modify the modal's appearance.  

4. **Divi Adjustments**:  
   - The plugin inherits Divi's styling by default. Additional styling can be added in `style.css` if needed.  

---

### **WPML & Divi Compatibility Notes**

- **WPML Integration**:  
  The plugin dynamically uses WPML's language URLs, ensuring redirection and compatibility with WPML's language switcher.  

- **Divi Support**:  
  The modal is fully responsive and styled to work seamlessly with Divi's custom layouts, ensuring no disruption to the user experience.  

---

### **Contributing**

Feel free to fork this repository and contribute to the plugin! If you encounter any issues or have feature requests, please create an issue on GitHub.  

---

### **License**

This plugin is open-source and distributed under the [MIT License](https://opensource.org/licenses/MIT). You are free to use, modify, and distribute it as per the terms of the license.  
