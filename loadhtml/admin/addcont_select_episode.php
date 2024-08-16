                    <div id=videupload-text class=nameanime>
                        
                    </div> 
                    <div id=backgroundplayer>
                        player
                    </div>
                    <div id=addcont_select>   
                        <div id=videupload-text>
                            Таймкоды
                        </div>  
                        
                        <div id="timecodes">
                            <div id="formtimecodes">
                                <div>
                                    <div style=width:100px; class=fromvideostart id="button">Из видео</div>
                                    <input class=starttimecode style=width:100px; type="number" step="0.01" value=0.0 id="inputtext">  
                                </div> 
                                <div>
                                    <div style=width:100px; class=fromvideoend id="button">Из видео</div>
                                    <input class=endtimecode style=width:100px; type="number" step="0.01" value=0.0 id="inputtext">  
                                </div>
                                <select name=typetimecode id=selectfield>
                                    <option selected value='intro'>Начало</option>
                                    <option value='titler'>Титры</option>
                                </select>
                                <div class=addtimecode id="button">Добавить</div>
                            </div>
                            
                        </div>
                        
                        <div id=videupload-text class=upg>
                            Обработка
                        </div>
                        <div id=lineback>
                            <div id=lineprogress>
                            </div>
                        </div>
                        <div id=videupload-text>
                            Имя серии
                        </div>
                        <input name=nameepisode id=inputtext>                  
                        <div id=videupload-text>
                            Серия
                        </div>
                        <input name=episode id=inputtext value=1>
                        <div id=videupload-text>
                            Сезон
                        </div>
                        <input name=season id=inputtext value=1>                       
                        <div id=videupload-text>
                            Тип
                        </div>
                        <select name=type_addcont id=selectfield>
                            <option value=0>Опубликовать</option>
                            <option selected value=1>Скрыто</option>
                        </select>
                        <input hidden name=link id=inputtext>
                        <input hidden name=idanime id=inputtext>
                        <input hidden name=poster id=inputtext>
                        <div id="hor">
                            <div class='save_addcont' id="button">Сохранить</div>
                            <div class='del_addcont' id="button">Удалить</div>
                        </div>
                    </div>


                    <div id=addcont_table></div>
{{ SCRIPT.PLAYER }}
