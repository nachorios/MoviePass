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