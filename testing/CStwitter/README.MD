# CS Twitter Wall
The Twitter wall is decided into 3 main sections:
- Carousel Part
- Main Display
- Admin Panel

## Carousel Part
The Carousel is its own page which will scale to any screen size that it is placed in, it works best when used in landscape mode.
The CSS sheet for this section is kept separate from other parts of the project to allow it to be moved to another project easier if desired.

## Main Display
The main display is the page that is actually viewed when displaying the wall. 
It is a basic HTML/CSS grid system as can be seen in style.css, with 5 sections to the grid.
The header section is at the top of the page and contains the UOY logo, left right and footer are just set to have a background colour to create a border.
The final section is the main section and contains an iframe which displays the Carousel page of the project.

The decision to set up this way was to provide an easy interface to change the design of the border with only needing a low level of CSS and HTML knoledge needed to do.
This method also keeps the more complex carousel code separate from the display code