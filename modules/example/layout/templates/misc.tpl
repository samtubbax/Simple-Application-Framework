{include:'{$CORE_PATH}/layout/templates/head.tpl'}
{include:'{$CORE_PATH}/layout/templates/nav.tpl'}

<div id="contentWrap">
	<div id="content">
		<header id="header" role="banner">
			<div class="container bar">
				<div class="title">
					<a id="toggleMenu" class="visible-phone iconLink" href="#">{$lblMenu|uppercase}</a>
					<h2>Miscellaneous <small>Lightweight utility components</small></h2>
				</div>
			</div>
		</header>

      	{include:'{$CORE_PATH}/layout/templates/notifications.tpl'}

		<section id="main" role="main">
			<div class="container">
				<section id="misc">
				<h2>Wells</h2>
				<p>Use the well as a simple effect on an element to give it an inset effect.</p>
				<div class="bs-docs-example">
					<div class="well">
						Look, I'm in a well!
					</div>
				</div>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"well"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">  ...</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol></pre>
				<h3>Optional classes</h3>
				<p>Control padding and rounded corners with two optional modifier classes.</p>
				<div class="bs-docs-example">
					<div class="well well-large">
						Look, I'm in a well!
					</div>
				</div>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"well well-large"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">  ...</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol></pre>
				<div class="bs-docs-example">
					<div class="well well-small">
						Look, I'm in a well!
					</div>
				</div>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"well well-small"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">  ...</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol></pre>

				<h2>Close icon</h2>
				<p>Use the generic close icon for dismissing content like modals and alerts.</p>
				<div class="bs-docs-example">
					<p><button class="close" style="float: none;">×</button></p>
				</div>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;button</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"close"</span><span class="tag">&gt;</span><span class="pln">&amp;times;</span><span class="tag">&lt;/button&gt;</span></li></ol></pre>
				<p>iOS devices require an <code>href="#"</code> for click events if you would rather use an anchor.</p>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;a</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"close"</span><span class="pln"> </span><span class="atn">href</span><span class="pun">=</span><span class="atv">"#"</span><span class="tag">&gt;</span><span class="pln">&amp;times;</span><span class="tag">&lt;/a&gt;</span></li></ol></pre>

				<h2>Helper classes</h2>
				<p>Simple, focused classes for small display or behavior tweaks.</p>

				<h4>.pull-left</h4>
				<p>Float an element left</p>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="kwd">class</span><span class="pun">=</span><span class="str">"pull-left"</span></li></ol></pre>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="pun">.</span><span class="pln">pull</span><span class="pun">-</span><span class="pln">left </span><span class="pun">{</span></li><li class="L1"><span class="pln">  </span><span class="kwd">float</span><span class="pun">:</span><span class="pln"> left</span><span class="pun">;</span></li><li class="L2"><span class="pun">}</span></li></ol></pre>

				<h4>.pull-right</h4>
				<p>Float an element right</p>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="kwd">class</span><span class="pun">=</span><span class="str">"pull-right"</span></li></ol></pre>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="pun">.</span><span class="pln">pull</span><span class="pun">-</span><span class="pln">right </span><span class="pun">{</span></li><li class="L1"><span class="pln">  </span><span class="kwd">float</span><span class="pun">:</span><span class="pln"> right</span><span class="pun">;</span></li><li class="L2"><span class="pun">}</span></li></ol></pre>

				<h4>.muted</h4>
				<p>Change an element's color to <code>#999</code></p>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="kwd">class</span><span class="pun">=</span><span class="str">"muted"</span></li></ol></pre>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="pun">.</span><span class="pln">muted </span><span class="pun">{</span></li><li class="L1"><span class="pln">  color</span><span class="pun">:</span><span class="pln"> </span><span class="com">#999;</span></li><li class="L2"><span class="pun">}</span></li></ol></pre>

				<h4>.clearfix</h4>
				<p>Clear the <code>float</code> on any element</p>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="kwd">class</span><span class="pun">=</span><span class="str">"clearfix"</span></li></ol></pre>
				<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="pun">.</span><span class="pln">clearfix </span><span class="pun">{</span></li><li class="L1"><span class="pln">  </span><span class="pun">*</span><span class="pln">zoom</span><span class="pun">:</span><span class="pln"> </span><span class="lit">1</span><span class="pun">;</span></li><li class="L2"><span class="pln">  </span><span class="pun">&amp;:</span><span class="pln">before</span><span class="pun">,</span></li><li class="L3"><span class="pln">  </span><span class="pun">&amp;:</span><span class="pln">after </span><span class="pun">{</span></li><li class="L4"><span class="pln">    display</span><span class="pun">:</span><span class="pln"> table</span><span class="pun">;</span></li><li class="L5"><span class="pln">    content</span><span class="pun">:</span><span class="pln"> </span><span class="str">""</span><span class="pun">;</span></li><li class="L6"><span class="pln">  </span><span class="pun">}</span></li><li class="L7"><span class="pln">  </span><span class="pun">&amp;:</span><span class="pln">after </span><span class="pun">{</span></li><li class="L8"><span class="pln">    clear</span><span class="pun">:</span><span class="pln"> both</span><span class="pun">;</span></li><li class="L9"><span class="pln">  </span><span class="pun">}</span></li><li class="L0"><span class="pun">}</span></li></ol></pre>
			</div>
		</section>
	</div>
</div>

{include:'{$CORE_PATH}/layout/templates/footer.tpl'}
</body>
</html>