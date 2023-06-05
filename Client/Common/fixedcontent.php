<div id="fixedContent">
    <div class="fixedcontentbox1 fixedContentDiv shadow">
        <div id="divfixedTopcontent">
            <?php echo $id >= 1 ? '<div id="userprofile">
                <div id="headerDiv2">
                    <div id="profilePost" class="shadow">' . ucfirst(substr($username, 0, 1)) . '</div>
                    <div id="nameMore">
                        <div id="name">' . $username . '</div>
                        <div id="date">
                            <span>' . $email . '</span>
                        </div>
                    </div>
                </div>
                <div class="divline mt-2"></div>
                    </div>' : '' ?>

            <div class="logoandContent">
                <h3 class="clsLogo">E-NoteBook</h3>
                <p class="clsContentl">Unlock Knowledge, Ace Your Journey: eNotebook - Your Gateway to Comprehensive
                    Notes and Study Material.</p>
            </div>
        </div>
        <div class="divline"></div>
        <div class="contentbtns">
            <?php
            if (intval($id) > 0) {
                echo '
                <button id="createpost" class="shadow" onclick="modalOpen()">Create Post</button>
                ';
            }
            ?>
            <a href="notes.php">
                <button id="notes" class="shadow SeeNoteIndex" style="width: 100%">See Notes</button>
            </a>
        </div>
    </div>
    <?php
    if (!isset($_GET['id'])) {
        echo '
        <div class="fixedcontentbox2 fixedContentDiv shadow" id="recentPostContentFulldiv">
        <h3 id="recentTitle">Recent Post:</h3>
        <div id="recentPostdata">
        
        </div>
        </div>
        ';
    }
    ?>
    <div class="fixedcontentbox3 fixedContentDiv shadow">
        <h3 id="recentTitle">Contents:</h3>
        <div class="linksforContent">
            <li><a href="notes.php" target="blank">Notes</a></li>
            <li><a href="previousquestions.php" target="blank">Question paper</a></li>
            <li><a href="syllabus.php" target="blank">Syllabus</a></li>
            <li><a href="#" target="blank">Blogs</a></li>
        </div>

        <div class="divline"></div>
        <footer class="footercontent">
            E-NoteBook © <span id="currentYear"></span> | All rights reserved
        </footer>


    </div>
</div>