<div id="mainText">
<h1 align="center"> Changelog </h1>
  <table style="width:100%; max-width:1200px;" align="center" id="normalFont">
		<tr>
			<th width="100"><h2>Version</h2></th>
			<th width="120"><h2>Date of change</h2></th>
			<th ><h2>Notes</h2></th>
		</tr>

      <?php
      $changelogArr = array(
        1  =>  array(
            "version"       =>  "1.0",
            "date"          =>  "1/13/2014",
            "notes"         =>  array(
                "Features"      =>  array("Inital Upload","Home page","About page","Art page")
            )
        ),
        2  =>  array(
            "version"       =>  "1.0.1",
            "date"          =>  "1/20/2014",
            "notes"         =>  array(
                "Features"      =>  array("Improved links on about page"),
                "Bug Fixes"     =>  array("Improved scroll bars on art page","Increased size of drop down menu (when viewing the site on smaller screens or mobile phones)","Fixed issue with Bebas font not displaying correctly on some pages")
            )
        ),
        3  =>  array(
            "version"       =>  "2.0",
            "date"          =>  "12/22/2015",
            "notes"         =>  array(
                "Features"      =>  array("Update theme of website","Added improved mobile navigation ","Changed visual layout of pages (Home, About, Art) ","Added pages (social, work, animations, website, work in progress")
            )
        ),
        4  =>  array(
            "version"       =>  "2.0.1",
            "date"          =>  "12/23/2015",
            "notes"         =>  array(
                "Features"      =>  array("Added favicon"),
                "Bug Fixes"     =>  array("Fixed case sensitive issues on links to pages and objects","Fixed misc. broken links")
            )
        ),
        5  =>  array(
            "version"       =>  "2.0.2",
            "date"          =>  "12/24/2015",
            "notes"         =>  array(
                "Mobile Bug Fixes"     =>  array("Fixed double logo in nav bar at top","Fixed spacing issues on mobile side nav bar","Fixed padding for buttons on side nav bar")
            )
        ),
        6  =>  array(
            "version"       =>  "2.1",
            "date"          =>  "7/12/2016",
            "notes"         =>  array(
                "Features"      =>  array("Added two new pages (Videos and Apps)"),
                "Bug Fixes"     =>  array("Fixed issues with links on some sub menu bars.")
            )
        ),
        7  =>  array(
            "version"       =>  "2.2",
            "date"          =>  "7/20/2016",
            "notes"         =>  array(
                "Features"      =>  array("Updated the look of the showcase pages to a slightly new look","Changed the background color to a lighter shade of grey","Update the mobile look of the Work page")
            )
        ),
        8  =>  array(
            "version"       =>  "2.2.1",
            "date"          =>  "10/20/2016",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Updated header info for some pages","Updated links to some pages")
            )
        ),
        9  =>  array(
            "version"       =>  "2.2.2",
            "date"          =>  "1/22/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Fixed font size issues on mobile","Fixed issues with mobile bar size")
            )
        ),
        10  =>  array(
            "version"       =>  "2.2.3",
            "date"          =>  "2/5/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Hides logo text in main nav bar at some resolutions","Updated logo text on index for small width desktop viewing")
            )
        ),
        11  =>  array(
            "version"       =>  "2.2.4",
            "date"          =>  "2/7/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Adjusted on hover in nav bar to slightly change color of background")
            )
        ),
        12  =>  array(
            "version"       =>  "2.2.5",
            "date"          =>  "3/2/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Updated social media page")
            )
        ),
        13  =>  array(
            "version"       =>  "2.2.6",
            "date"          =>  "3/5/2017",
            "notes"         =>  array(
                "Features"      =>  array("Added link to github issues on feedback bar"),
                "Bug Fixes"     =>  array("Cursor pointer changes to pointer when hovering over feedback bar link")
            )
        ),
        14  =>  array(
            "version"       =>  "2.2.6.2",
            "date"          =>  "3/5/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Added fade on hover for social media pictures")
            )
        ),
        15  =>  array(
            "version"       =>  "2.2.6.4",
            "date"          =>  "3/5/2017",
            "notes"         =>  array(
                "Bug Fixes"     =>  array("Fixed some links on mobile nav bar")
            )
        ),
        16  =>  array(
            "version"       =>  "3.0",
            "date"          =>  "11/11/2018",
            "notes"         =>  array(
                "Features"      =>  array("Switched code base from just using html to using php and xml","Changed up theme","Redesigned nav bar","Redesigned most pages")
            )
        ),
        17  =>  array(
            "version"       =>  "3.0.1",
            "date"          =>  "12/24/2018",
            "notes"         =>  array(
                "Features"      =>  array("Updated WebCoreMJR to 0.1.1","Switched galleries from local lightbox to built in lightbox")
            )
        ),
        18  =>  array(
            "version"       =>  "3.0.2",
            "date"          =>  "1/6/2019",
            "notes"         =>  array(
                "Features"      =>  array("Updated WebCoreMJR to 0.1.2")
            )
        ),
        19  =>  array(
            "version"       =>  "3.0.2.1",
            "date"          =>  "1/6/2019",
            "notes"         =>  array(
                "Bug Fixes"      =>  array("Updated WebCoreMJR to 0.1.2.1","Updated some gallery images")
            )
        ),
        20  =>  array(
            "version"       =>  "3.0.2.2",
            "date"          =>  "1/12/2019",
            "notes"         =>  array(
                "Content Update"      =>  array("Added link to WebCoreMJR","Added changelog link in footer","Updated social media links","Added old 2014 portfolio to gallery")
            )
        )
      );
      $odd = false;
      $changelogArr = array_reverse($changelogArr);
      foreach ($changelogArr as $key => $value): 
        $odd = !$odd;?>
        <tr <?php if($odd){ echo "bgcolor=\"#333333\""; }?> >
            <th><?php echo $value["version"]; ?></th>
            <th><?php echo $value["date"]; ?></th>
            <th align="left">
                <?php foreach ($value["notes"] as $key2 => $value2): ?>
                    <h3 align="center"><?php echo $key2; ?></h3>
                    <ul>
                        <?php foreach ($value2 as $value3): ?>
                            <li>
                                <?php echo $value3; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul> 
                <?php endforeach; ?>
            </th>
        </tr> 
      <?php endforeach; ?>
</table>
</div>