<?php 
	if($this->uri->segment("1") == 'Ver-Projeto' || $this->uri->segment("1") == 'Atualizar-Projeto-Banco'){
		$url = 'Comentar-Projeto';
		$del = 'Deletar-Avaliacao-Projeto';
		$piId = 'projeto_id';
		$tabela = 'avaliacaoProjeto';
	}else if($this->uri->segment("1") == 'Ver-Ideia' || $this->uri->segment("1") == 'Atualizar-Ideia-Banco'){
		$url = 'Comentar-Ideia';
		$del = 'Deletar-Avaliacao-Ideia';
		$piId = 'ideia_id';
		$tabela = 'avaliacaoIdeia';
	}
	$id = $this->uri->segment("2");
	$userId = $this->session->userdata('id');
?>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--8-col">
		<h4>Comentários <i class="material-icons">short_text</i></h4>
		<form method="post" action="<?= base_url($url . '/' . $id) ?>">
			<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
				<thead>
					<tr>
						<th class="mdl-data-table__cell--non-numeric"><i class="material-icons">account_circle</i>Usuário</th>
						<th class="mdl-data-table__cell--non-numeric"><i class="material-icons">short_text</i>Avaliação</th>
						<th class="mdl-data-table__cell--non-numeric"><i class="material-icons">stars</i>Nota</th>
						<th class="mdl-data-table__cell--non-numeric"><i class="material-icons">check_circle</i>Enviar</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="mdl-data-table__cell--non-numeric"><?= $this->session->userdata('nome') ?></td>
						<td class="mdl-data-table__cell--non-numeric">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				            <input class="mdl-textfield__input" type="text" id="comentario" name="avaliacao" required>
				            <label class="mdl-textfield__label" for="avaliacao" >Comentario</label>
				          </div>
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<input type="range" name="valor" class="mdl-slider mdl-js-slider" min="0" max="10" value="0" tabindex="0">
							<input type="hidden" name="usuario_id" value="<?= $this->session->userdata('id') ?>">
							<input type="hidden" name="<?= $piId ?>" value="<?= $id ?>">
						</td>
						<td class="mdl-data-table__cell-non-numeric">
							<button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
				              <i class="material-icons">send</i>
				            </button>
						</td>
					</tr>
				</form>
					<?php 
						$query = $this->db->query("SELECT op.id as idAv, op.avaliacao, op.valor, nome, u.id FROM $tabela as op 
													JOIN usuario u 
													ON op.usuario_id = u.id 
													WHERE op.$piId = $id 
													ORDER by op.id DESC");
			            $resultado = $query->result();

			            foreach ($resultado as $row) {
					?>
					<tr>
						<td class="mdl-data-table__cell--non-numeric"><a href="<?= base_url('Painel/' . $row->id) ?>"><?= $row->nome ?></a></td>
						<td class="mdl-data-table__cell--non-numeric">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		                        <textarea class="mdl-textfield__input" name="avaliacao" cols="40" disabled><?= $row->avaliacao ?></textarea>
		                        
		                    </div>
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<input type="range" name="valor" class="mdl-slider mdl-js-slider" min="0" max="10" value="<?= $row->valor ?>" disabled>
						</td>
						<?php if($row->id == $this->session->userdata('id')) { ?>
							<form action="<?= base_url($del . '/' . $row->idAv) ?>">
							<td class="mdl-data-table__cell-non-numeric">
								<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
					              <i class="material-icons">clear</i>
					            </button>
							</td>	
							</form>
						<?php } ?>
					</tr>
					<? } ?>
				</tbody>
			</table>
	</div>
</div>