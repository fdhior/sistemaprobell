<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">  
    <xsl:call-template name="menu"/> 
	<div id="apDiv1">
    <form id="grid_form_id">
      <table id="list_table" border="1" cellpadding="0" cellspacing="0">  
        <xsl:for-each select="data/grid/row1">
          <xsl:element name="tr">
            <xsl:attribute name="id">
              <xsl:value-of select="idinmu" />
            </xsl:attribute>     
<!-- 0 -->  <td class="table_td1"><xsl:value-of select="idinmu" /></td>
<!-- 1 -->  <td class="table_td2"><xsl:value-of select="nombreinmu" /></td>
<!-- 2 -->  <td class="table_td3"><xsl:value-of select="tipo" /></td>
<!-- 3 --> 	<td class="table_td4">
			<select class="select1" name="razonsc" disabled="disabled">
				<option><xsl:value-of select="razonsc" /></option>
				<xsl:for-each select="data/grid/row2">
		        <xsl:element name="option">
				<xsl:value-of select="razon" />
              	    <!--<xsl:attribute name="id2">
	                	<xsl:value-of select="idfis" />
    		    	</xsl:attribute>-->
                </xsl:element>
	            </xsl:for-each>
         	</select>

            </td>      
<!-- 4 --> 	<!--<td class="hid_td"><xsl:value-of select="direccion" /></td>-->
<!-- 5 -->  <!--<td class="hid_td">
	  		<textarea class="showDirec" name="direccion" cols="17"  rows="1" disabled="disabled"><xsl:value-of select="direccion" /></textarea>
            <xsl:element name="a">
                <xsl:attribute name = "href">#</xsl:attribute>
                <xsl:attribute name = "onclick">
                  editId(<xsl:value-of select="idinmu" />, true)
                </xsl:attribute>
                Editar
              </xsl:element>
			</td>-->               
<!-- 4 -->  <td class="table_td5"><xsl:value-of select="direccion" /></td>      
   			<td class="table_td6"><xsl:value-of select="zona" /></td>
   			<td class="table_td7"><xsl:value-of select="idubica" /></td>
			<td class="table_td8"><xsl:value-of select="estado" /></td>
   			<td class="table_td9">
            <xsl:element name="a">
                <xsl:attribute name = "href">#</xsl:attribute>
                <xsl:attribute name = "onclick">
                  editId(<xsl:value-of select="idinmu" />, true)
                </xsl:attribute>
                Editar
              </xsl:element>
             </td>      
          </xsl:element>
        </xsl:for-each>
      </table>
    </form>
   </div>
   <xsl:call-template name="menu" /> 
  </xsl:template>
  <xsl:template name="menu">
    <xsl:for-each select="data/params">
<!--      <table>
        <tr>
          <td class="left">
            <xsl:value-of select="items_count" /> Items
          </td> 
          <td class="right"> 
            <xsl:choose>
              <xsl:when test="previous_page>0">
                <xsl:element name="a" >
                  <xsl:attribute name="href" >#</xsl:attribute>
                  <xsl:attribute name="onclick">
                    loadGridPage(<xsl:value-of select="previous_page"/>)
                  </xsl:attribute>
                  Previous page
                </xsl:element>
              </xsl:when> 
            </xsl:choose>
          </td>   
          <td class="left">
            <xsl:choose>
              <xsl:when test="next_page>0">
                <xsl:element name="a">
                  <xsl:attribute name = "href" >#</xsl:attribute>
                  <xsl:attribute name = "onclick">
                    loadGridPage(<xsl:value-of select="next_page"/>)
                  </xsl:attribute>
                  Next page
                </xsl:element>
              </xsl:when> 
            </xsl:choose>
          </td>
          <td class="right">
            page <xsl:value-of select="returned_page" />
            of <xsl:value-of select="total_pages" />
          </td>  
        </tr>
      </table>-->
    </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>
