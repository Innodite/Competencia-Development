CREATE FUNCTION insertar_usuario(pnombre character varying) 
RETURNS boolean AS $BODY$
begin
INSERT INTO usuario(nombre) VALUES (pnombre);
if found then
return true;
else
return false;
end if;
end;$BODY$
LANGUAGE 'plpgsql'

CREATE OR REPLACE VIEW ver_usuario AS 
SELECT id,nombre from usuario where nombre='anthony'

select nombre FROM ver_usuario

alter table competidor
 add constraint NOMBRECONSTRAIN
 check (char_length(trim(nombre))<>0)