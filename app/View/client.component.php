<tr>
      <th scope="row"><? echo $client->id; ?></th>
      <td> <? echo $client->name ?> </td>
      <td> <? echo $client->birthday; ?> </td>
      <td> <? echo $client->cpf; ?> </td>
      <td> <? echo $client->rg; ?> </td>
      <td> <? echo $client->phone_number; ?> </td>
      <td <? foreach ($client->withaddress() as $key => $a) {?> 
                  <p> <?=$a->address?> </p>

      <? } ?> 
      </td>
      <td>  <a href="/clientes/criar/<?=$client->id?>" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Editar</a></td>
      <td> <a href="/clientes/remover/<?=$client->id?>" class="btn btn-danger btn-sm" role="button" aria-disabled="true">Excluir</a> </td>
</tr>