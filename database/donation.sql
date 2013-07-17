CREATE TABLE IF NOT EXISTS `donation` (
  `username` varchar(32) NOT NULL,
  `time` varchar(100) NOT NULL,
  `productid` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `tickets` int(11) NOT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;