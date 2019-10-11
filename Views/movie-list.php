<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de peliculas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Titulo</th>
                         <th>Tiempo</th>
                         <th>Idioma</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($movieList as $movie):
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getTitle() ?></td>
                                             <td><?php echo $movie->getTime() ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                        </tr>
                                   <?php
                              endforeach;
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>