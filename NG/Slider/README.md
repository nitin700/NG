NG Slider Open Source 1.0.0 Release Notes

NG Slider has been released its first Version which given an additional advantage to store in Sale by promoting Best products or upcomming events in Slider.
It also help a lot in Promotions of Sale , Coupons, Offers, Notice or any Information want to share for about your store.
As Module gives you an advantage of adding unlimited Slides in slider along with Redirection Link, you can have all above mentioned features for your multistores.

Features:
1)  Can Add unlimited Slides from admin and command (Alternate option but not recommended).
2)  Easy to implement or call on any page.
3)  Easy to manage from backend.
4)  Each slide can have their onw redirection links, which can be configure from admin.
5)  Configurable Caption enable/disable.
6)  Option To resize images in ratio you want for slider (But its recommended to upload all images of exact size for better experience & look).
7)  can set position for each slide.
8)  Individual Slide Active/Deactive option.
9)  Caption option provided, if some description want to display along with slide.
10) Navigation option.
11) Auto start slider option.
12) Fade/Slide Transition option.
13) Thumbnail image of slide in Admin GRID to choose right slide for modification.
14) Mass Slide / Custom Slide Delition option backend.
15) Easily Enable and disable whole slider from backend etc..

Backend Configurations :
1) slider enable
1) Load Jquery: online / offline
2) transition mode: 'horizontal', 'vertical', 'fade' (comments: Type of transition between slides)
3) transition speed : Integer (comment: Slide transition duration (in ms))
4) captions true/false (slide captions enble)
5) controls : If true, "Next" / "Prev" controls will be added
6) autoControls : If true, "Start" / "Stop" controls will be added
7) autoControlsCombine : When slideshow is playing only "Stop" control is displayed and vice-versa
8) auto : false	Slides will automatically transition
9) autoStart : Auto show starts playing on load. If false, slideshow will start when the "Start" control is clicked
How to Install the module :
option 1) copy and paste the downloaded folder & file to app/code/NG/Slider
option 2) Install the module via composer
-	Run the following commands in terminal-
-	php bin/magento setup:upgrade (Execution of this command is optional, Just to make sure all configuration and Modules are updated).
-	composer require NG/Slider 
-	php bin/magento setup:upgrade

How to test the module is properly installed :
1) login to admin
2) Left Navigation NG Slider menu will Appear.

How to add slide from Backend : 
1) Login to Admin
2) Navigate to NG Slider menu in left side main menu.
3) Click "Create New Slide" button on right top corner.
4) Fill the form and upload image and save.
How to add slide via Command
1) bin/magento ng:slide:add "option1" "option2" option3 "option4" option5

2) after above command execute, upload the image (Option1) at path : "\pub\media\NG_Slider"
below are the options
option1 : NG_Slider/<imageName>  (e.g: NG_Slider/ngSlide_1537089043.jpg)
option2 : if Any description about slide to display in caption or else keep empty (e.g "")
option3 : position of image (numeric value, e.g 1 or 2 etc...)
option4 : Redirection url for slide (e.g: on click of slide you want to redirect slide to any url)
option5 : Status of Slide (1 for active, 0 for dactive)




How to add change configuration of slider from Backend : 
1) Login to Admin
2) Navigate to Stores -> Configuration -> NG Slider menu in left side main menu.
3) Click "Create New Slide" button on right top corner.
4) Fill the form and upload image and save.

How to call slider on Home Page :
{{block class="NG\Slider\Block\Slide" template="NG_Slider::slide.phtml"}}
paste above content in Home Page Block
