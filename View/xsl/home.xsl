<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
    version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
    xmlns:php="http://php.net/xsl"
>
    <xsl:output
        method="html"
        omit-xml-declaration="yes"
        doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
        doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
        indent="yes"
    />
    
	<!-- start proc template -->
	<xsl:template match="proc">
	    
	    <xsl:variable name="page" select="'home'" />
	    <xsl:variable name="l" select="get/l" />
	    
	    <html xmlns="http://www.w3.org/1999/xhtml">
	        
            <head>
                
                <title><xsl:value-of select="translate/lang[@iso=$l]/title" /></title>
                
            </head>
            
            <body>
                
                <h1><xsl:value-of select="translate/lang[@iso=$l]/text" /></h1>
                
            </body>
         
	    </html>
	    
    </xsl:template>
	<!-- end proc template -->
    
</xsl:stylesheet>