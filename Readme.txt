Remember to edit your database configuration:
\website\vote\classes\db-details.php
\website\donation\db.php

And your Paypal email:
\website\donation\paypal.php ($EMAIL)

Consequently, the same will need to be done server-sided too.
If you are using a command line compiler, remember to add the "libs" folder to your build path.
(Adding: lib/*; after specifying the classpath)
Example:
	javac -d bin -cp lib/*; -sourcepath src
	
And the same for your run:
java -Xmx1024m -cp bin;lib/* mainClass