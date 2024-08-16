                    <div id=addbanner>
                        <div id="addbtnupload" class=styleuploadbtn>Загрузить</div>
                        <input hidden id="addbannerimg">
                    </div> 
                    <div id=blockprevfield>                  
                        <div id=addprev>
                            <div type="prev" id="addprevimg" class=styleuploadbtn>Загрузить</div>      
	                        <input hidden id="addprevimg">
                        </div>
                        <div id=fieldadd>
                            <div id=textfield>
                                Название    
                            </div>
                            <input class='namecont' id=inputtext type=text value="">
                            <div id=textfield>
                                Оригинальное название 
                            </div>
                            <input class="origname" id=inputtext type=text value=""> 
                            <div id=textfield>
                                Ссылка 
                            </div>
                            <input class="linkSpace" id=inputtext type=text value=""> 
                            <div id=textfield>
                                Год
                            </div>
                            <select class=yearcont id=selectfield>
                            </select>
                            <div id=textfield>
                                Возрастное ограничение
                            </div>
                            <select class=watchyearcont id=selectfield>
                                <option value=0>0+</option>
                                <option value=6>6+</option>
                                <option value=12>12+</option>
                                <option value=16>16+</option>
                                <option value=18>18+</option>
                                <option value=80>80+</option>
                            </select>
                            <div id=textfield>
                                Статус
                            </div>
                            <select class=statuscont id=selectfield>
                                <option value=1>Опубликовать</option>
                                <option selected value=0>Скрыто</option>
                            </select> 
                            <div id=textfield>
                                Тип
                            </div>
                            <select class=typecont id=selectfield>
                                <option selected value=1>Сериал</option>
                                <option value=0>Полнометражка</option>
                            </select>
                            <div id=textfield>
                                Описание 
                            </div>
                            <textarea class=desccont id=textarea></textarea>
                            <div id=hor>
                                <div class=prevcont id="button">Предпросмотр</div>
                                <div class=addcont id="button">Добавить</div>
                            </div>
                            
                        </div>
                        <div id=genrefield> 
                            <div id=textfield>
                                Жанры
                                <div>
                                    {{ ADMIN.GENRE }}
                                </div>
                            </div>
                        </div>
                    </div>