<?php
session_start();
$pagename="Lokisalle";
include('menu.php'); ?>

    <div class="container">
        <div class="row">

            <!-- MIXITUP -->

            <!--<div class="controls">
                <button type="button" class="control" data-filter="all">All</button>
                <button type="button" class="control" data-filter=".green">Green</button>
                <button type="button" class="control" data-filter=".blue">Blue</button>
                <button type="button" class="control" data-filter=".pink">Pink</button>
                <button type="button" class="control" data-filter="none">None</button>

                <button type="button" class="control" data-sort="default:asc">Asc</button>
                <button type="button" class="control" data-sort="default:desc">Desc</button>
            </div> -->

            <form class="controls" id="Filters">
                <!-- We can add an unlimited number of "filter groups" using the following format: -->

                <fieldset class="filter-group checkboxes">
                    <h4>Shapes</h4>
                    <div class="checkbox">
                        <input type="checkbox" value=".salle1" />
                        <label>Square</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" value=".salle2" />
                        <label>Circle</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" value=".salle3" />
                        <label>Triangle</label>
                    </div>
                </fieldset>

                <fieldset class="filter-group checkboxes">
                    <h4>Colours</h4>
                    <div class="checkbox">
                        <input type="checkbox" value=".white" />
                        <label>White</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" value=".green" />
                        <label>Green</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" value=".blue" />
                        <label>Blue</label>
                    </div>
                </fieldset>

                <fieldset class="filter-group checkboxes">
                    <h4>Sizes</h4>
                    <div class="checkbox">
                        <input type="checkbox" value=".sm" />
                        <label>Small</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" value=".lrg" />
                        <label>Large</label>
                    </div>
                </fieldset>

                <fieldset class="filter-group search">
                    <h4>Search</h4>
                    <input type="text" placeholder="Search ..." />
                </fieldset>

                <button id="Reset">Clear Filters</button>
            </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.js"></script>

            <script>
                // To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".

                var multiFilter = {

                    // Declare any variables we will need as properties of the object

                    $filterGroups: null,
                    $filterUi: null,
                    $reset: null,
                    groups: [],
                    outputArray: [],
                    outputString: '',

                    // The "init" method will run on document ready and cache any jQuery objects we will need.

                    init: function() {
                        var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

                        self.$filterUi = $('#Filters');
                        self.$filterGroups = $('.filter-group');
                        self.$reset = $('#Reset');
                        self.$container = $('#Container');

                        self.$filterGroups.each(function() {
                            self.groups.push({
                                $inputs: $(this).find('input'),
                                active: [],
                                tracker: false
                            });
                        });

                        self.bindHandlers();
                    },

                    // The "bindHandlers" method will listen for whenever a form value changes. 

                    bindHandlers: function() {
                        var self = this,
                            typingDelay = 300,
                            typingTimeout = -1,
                            resetTimer = function() {
                                clearTimeout(typingTimeout);

                                typingTimeout = setTimeout(function() {
                                    self.parseFilters();
                                }, typingDelay);
                            };

                        self.$filterGroups
                            .filter('.checkboxes')
                            .on('change', function() {
                                self.parseFilters();
                            });

                        self.$filterGroups
                            .filter('.search')
                            .on('keyup change', resetTimer);

                        self.$reset.on('click', function(e) {
                            e.preventDefault();
                            self.$filterUi[0].reset();
                            self.$filterUi.find('input[type="text"]').val('');
                            self.parseFilters();
                        });
                    },

                    // The parseFilters method checks which filters are active in each group:

                    parseFilters: function() {
                        var self = this;

                        // loop through each filter group and add active filters to arrays

                        for (var i = 0, group; group = self.groups[i]; i++) {
                            group.active = []; // reset arrays
                            group.$inputs.each(function() {
                                var searchTerm = '',
                                    $input = $(this),
                                    minimumLength = 3;

                                if ($input.is(':checked')) {
                                    group.active.push(this.value);
                                }

                                if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
                                    searchTerm = this.value
                                        .trim()
                                        .toLowerCase()
                                        .replace(' ', '-');

                                    group.active[0] = '[class*="' + searchTerm + '"]';
                                }
                            });
                            group.active.length && (group.tracker = 0);
                        }

                        self.concatenate();
                    },

                    // The "concatenate" method will crawl through each group, concatenating filters as desired:

                    concatenate: function() {
                        var self = this,
                            cache = '',
                            crawled = false,
                            checkTrackers = function() {
                                var done = 0;

                                for (var i = 0, group; group = self.groups[i]; i++) {
                                    (group.tracker === false) && done++;
                                }

                                return (done < self.groups.length);
                            },
                            crawl = function() {
                                for (var i = 0, group; group = self.groups[i]; i++) {
                                    group.active[group.tracker] && (cache += group.active[group.tracker]);

                                    if (i === self.groups.length - 1) {
                                        self.outputArray.push(cache);
                                        cache = '';
                                        updateTrackers();
                                    }
                                }
                            },
                            updateTrackers = function() {
                                for (var i = self.groups.length - 1; i > -1; i--) {
                                    var group = self.groups[i];

                                    if (group.active[group.tracker + 1]) {
                                        group.tracker++;
                                        break;
                                    } else if (i > 0) {
                                        group.tracker && (group.tracker = 0);
                                    } else {
                                        crawled = true;
                                    }
                                }
                            };

                        self.outputArray = []; // reset output array

                        do {
                            crawl();
                        }
                        while (!crawled && checkTrackers());

                        self.outputString = self.outputArray.join();

                        // If the output string is empty, show all rather than none:

                        !self.outputString.length && (self.outputString = 'all');

                        console.log(self.outputString);

                        // ^ we can check the console here to take a look at the filter string that is produced

                        // Send the output string to MixItUp via the 'filter' method:

                        if (self.$container.mixItUp('isLoaded')) {
                            self.$container.mixItUp('filter', self.outputString);
                        }
                    }
                };

                // On document ready, initialise our code.

                $(function() {

                    // Initialize multiFilter code

                    multiFilter.init();

                    // Instantiate MixItUp

                    $('#Container').mixItUp({
                        controls: {
                            enable: false // we won't be needing these
                        },
                        animation: {
                            easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
                            queueLimit: 3,
                            duration: 600
                        }
                    });
                });

            </script>
            <div id="Container" class="container">
                <div class="fail-message"><span>No items were found matching the selected filters</span></div>

                <div class="mix triangle white lrg"></div>
                <div class="mix square white sm"></div>
                <div class="mix circle green lrg"></div>
                <div class="mix triangle blue lrg"></div>
                <div class="mix square white lrg"></div>
                <div class="mix circle blue sm"></div>
                <div class="mix triangle green lrg"></div>
                <div class="mix square blue lrg"></div>
                <div class="mix circle white lrg"></div>

                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
            </div>

            <!--<div class="container mixitup">

                <div class="mix salle1">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">15 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </p>
                        </div>
                    </div>
                </div>
                

                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
            </div>-->
            <!--<script src="js/mixitup.min.js"></script>-->

            <!--<script>
                var containerEl = document.querySelector('.container');

                var mixer = mixitup(containerEl);

            </script>-->



            <div class="col-md-3">
                <p class="lead">Lokisalle</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">

                colonne search ajax : Categorie - Réunion/Bureau/Formation Ville - Paris/Lyon/Marseille Capacité - 10/50... Prix - minimum/maximum Pédiode - Date d'arrivé/date de départ Colonne de visu des produits : Photo/nom salle/prix/mini description/date arrivée-depart/notation(etoiles)/bouton voir Bouton voir plus Ajax pour voir d'autres produits

                <div class="row">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                    </div>

                </div>

            </div>

        </div>


    </div>
    <?php
include('footer.php');
?>
