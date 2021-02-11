# ShareX Uploader
A super simple ShareX uploader with Discord embed and Twitter Card support.  

### Installation
First you must require PHP, a web server, htaccess enabled and a domain.  
Now you will want to download a release and upload the files to your web server.  
Open `protected/config.php` and you will see multiple options, configure those to your likings.  
Once everything has been configured you now want to create a folder called `uploads` and make sure the permissions are set to `777`.  

Now you can take the ShareX config from below, configure that and you are ready to use the uploader.  
```
{
  "Version": "13.2.1",
  "Name": "ShareX Uploader",
  "DestinationType": "ImageUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "https://your-domain.com/upload.php",
  "Body": "MultipartFormData",
  "Arguments": {
    "password": "your password"
  },
  "FileFormName": "file"
}
```  

### Information
All files you upload are put into `upload.php` the URL you copy after uploading links you to `view.php` which opens the image and views it as an embed. This is more effective than creating a new html file for every file you upload which is what was used in version 1.0.

### Support
If you require any support please create an issue in this Github with the label `Support`.
