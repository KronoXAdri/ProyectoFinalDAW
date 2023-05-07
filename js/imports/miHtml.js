export const exit = document.createElement('div');
exit.id = 'layout';

exit.innerHTML = "<div id='layout'>" + 
                    "<header class='d-flex flex-column align-items-center justify-content-center'>" +
                        "<h1 class='retro texto-centro mt-5' id='title'>" +
                            "SUPER SPIKES MAN!" +
                        "</h1>" +
                    " </header>" +
                    "<main class='d-flex flex-column align-items-center justify-content-center'>" +
                        "<div class='d-flex flex-column align-items-center justify-content-evenly exit mt-5 w-75'>" +
                            "<div class='W-100'>" +
                                "<h1 class='retro'> ¿Desea salir de la aplicación? </h1>" +
                            "</div>" +
                            "<div class='w-75 d-flex flex-row align-items-center justify-content-around'>" +
                                "<div class='yes'>" +
                                    "<p class='fs-1 retro'> SI </p>" +
                                "</div>" +
                                "<div class='no'>" +
                                    "<p class='fs-1 retro'> NO </p>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</main>"
                    " <div id='animated'>" +
                    "</div>" +
                "</div>";
