INSERT INTO `user` (`userid`, `username`, `password`, `email`, `disattivo`) VALUES
(1, 'MatteoRaga', 'matteo', 'matteo.ragazzini@gmail.com', 0),
(2, 'PaoloPenazzi', 'paolo', 'paolo.penazzi@gmail.com', 0),
(3, 'DavideApli', 'davide', 'davide.alpi@gmail.com', 0),

-- ALTER TABLE `user`
--   MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

INSERT INTO `event` (`eventid`, `eventname`, `eventcity`, `eventdescription`, `eventpreview`, `maxtickets`, `date`, `price`, `public`, `imgevent`, `organiser`) VALUES
(1, 'grigliata', 'forli', 'grigliata da me','6','2020-03-31','5','1','res/background7.jpg'.'1');

-- ALTER TABLE `event`
  -- MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;