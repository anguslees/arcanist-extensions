<?php

/*
 * Copyright 2013 Disqus, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class JenkinsDiffEventListener extends PhutilEventListener {

  public function register() {
    echo "listening for event -- \n";
    $this->listen(ArcanistEventType::TYPE_DIFF_WASCREATED);
    echo "Set listener on event -- \n";
    var_dump($this);
  }

  public function handleEvent(PhutilEvent $event) {
    echo "handling an event -- \n";
    $diff_id = $event->getValue('diffID');
    var_dump($diff_id);

    /* Need to send a get request to jenkins to trigger the job. We pass the
     * diff id to jenkins via its api.
     */
    $workflow = $event->getValue('workflow');
    $jenkins_uri = $workflow->getConfigFromAnySource('jenkins.uri');
    $jenkins_job = $workflow->getConfigFromAnySource('jenkins.job');
    $jenkins_token = $workflow->getConfigFromAnySource('jenkins.token');

    if (!$jenkins_uri || !$jenkins_job) {
      return;
    }

    $url = $jenkins_uri."/job/".$jenkins_job."/buildWithParameters?token=".$jenkins_token."&DIFF_ID=".$diff_id;

    file_get_contents($url);
  }
}
