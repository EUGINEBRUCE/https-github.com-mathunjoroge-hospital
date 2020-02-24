
<html> 
 <head> 
     <script language="JavaScript" type="text/javascript">  
         MyObject = new ActiveXObject( "WScript.Shell" )  
         function RunExe()   
         {  
            MyObject.Run("file:///C:/Program%20Files/adiAntViewer64bit/RadiAntViewer.exe") ;  
        }  
      
    </script> 
 </head> 
 <body> 
    <h1>Run a Program</h1> 
    This script launch the file any Exe File<p> 
    <button onclick="RunExe()">Run Exe File</button> 
    
 </body> 
</html> 
