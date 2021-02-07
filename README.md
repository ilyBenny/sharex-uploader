# ShareX Uploader
A super simple ShareX uploader with Discord embed and Twitter Card support.  

### Installation
First you must require PHP, a web server, htaccess enabled and a domain.  
Now you will want to download a release and upload the files to your web server.  
Open `upload.php` and at the top of the document you will see multiple options, configure those to your likings.  
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

### Support
If you require any support please create an issue in this Github with the label `Support`.
